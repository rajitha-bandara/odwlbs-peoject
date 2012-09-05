<?php
class MySqlDatabase
{
	private $_connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
	public function __construct()
	{
		$this->open_connection();
		/* Returns the current configuration setting of magic_quotes_gpc.
		Returns 0 if magic_quotes_gpc is off, 1 otherwise. */
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
	}
	
	public function open_connection()
	{
		$this->_connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		if(!$this->_connection)
		{
			die('Database connection failed'.mysql_error());
		}
		else
		{
			$db_select = mysql_select_db(DB_NAME,$this->_connection);
			if(!$db_select)
			{
				die('Database selection failed'.mysql_error());
			}
		}
	}
	
	public function close_connection()
	{
		if(isset($this->_connection))
		{
			mysql_close($this->_connection);
			unset($this->_connection);
		}
	}
	
	/* For SELECT returns resultset on success, false on error.
	 * For INSERT, UPDATE, DELETE etc returns true on success, false on error */
	public function query($sql)
	{
		$this->last_query = $sql;
	
		$result = mysql_query($sql,$this->_connection);
		//$this->confirm_query($result);
		return $result;
	}
	
	/* Make sure query executed successfully.
	 * Only for debugging purposes. */
	private function confirm_query($result)
	{
	
		if(!$result)
		{
			$output = "Databse query failed".mysql_error()."<br>";
			$output .= "Last query ".$this->last_query; 
	
			die($output);
		}
	}
	
	/* Escape special characters in the string before sending to the database
	 * Consider PHP Version*/
	public function escape_value($value)
	{
	
		if($this->real_escape_string_exists)// PHP version 4.3.0 or higher
		{
				
			if($this->magic_quotes_active)
			{
				/* Automatically add back slashes when magic quotes are active in php.ini
				 * First remove them. */
				$value = stripslashes($value);
			}
			//Escapes special characters in a string
			$value = mysql_real_escape_string($value);
		}
		else //before PHP version 4.3.0
		{
	
			if(!$this->magic_quotes_active)
			{
				// Add slashes manually
				$value = addslashes($value);
			}
		}
	
		return $value;
	}
	
	/* Returns an array of strings that corresponds to the fetched row.
	 * Returns FALSE if there are no more rows.*/
	public function fetch_array($result_set)
	{
		return mysql_fetch_array($result_set);
	}
	
	/* Retrives the number of rows from the result set.
	 * Returns FALSE on failure. */
	public function num_rows($result_set)
	{
		return mysql_num_rows($result_set);
	}
	
	/* Get the ID generated in the last query
	 * 0 if the previous query does not generate an AUTO_INCREMENT value.
	 * FALSE if no MySQL connection was established.  */
	public function insert_id()
	{
		return mysql_insert_id($this->_connection);
	}
	
	/* Get number of affected rows in previous MySQL operation.
	 * Return -1 if the last query failed.  */
	public function affected_rows()
	{
		return mysql_affected_rows($this->_connection);
	}
	
}
//Creates an object from MySQLDatabase class
$gdbObj = new MySqlDatabase();
?>