<?php

class Search 
{
	public $iNumOfResults;

	private $result;
	private $lastResult;
	private $db;
	private $strQuery;
	private $strLimits;
	private $strLimitedQuery;
	private $strKeyword;
	private $filter;  // search method ex. like,starts with,ends with
	
	protected static $table_search="lbs_search";
	protected static $table_search_temp="lbs_search";
	/**
	 * Search::construct()
	 *
	 * @param 
	 * $strQuery: string  query to execute
	 * @param
	 * $strKeyword string search keywords;
	 * 
	 */
	
	public function __construct($query,$startLimit,$endLimit)
	{
		$this->strLimits=' '.' LIMIT '.$startLimit.','.$endLimit;	
		$this->strQuery=$query;
		$this->strLimitedQuery=$this->strQuery.$this->strLimits;
	
	}
	
	
	/**
	 * Search::search()
	 * 
	 */
	public function getResult()
	{
		global $gdbObj;
		$gdbObj->open_connection();
		$result=$gdbObj->query($this->strLimitedQuery);
		if($result)
		return $result;
		
	}
	public function getAllResult()
	{
		global $gdbObj;
		$gdbObj->open_connection();
		$result=$gdbObj->query($this->strQuery);
		if($result)
			return $result;
	
	}
	public function getNoOfResult()
	{
		global $gdbObj;
		$this->iNumOfResults=mysql_num_rows($gdbObj->query($this->strQuery));
		return $this->iNumOfResults;
		
	}
	
	public static function track($what="",$where="",$user_latitude="",$user_longitude="")
	{
		global $gdbObj;
		$what = mysql_real_escape_string($what);
		$where = mysql_real_escape_string($where);
		
		$sql = "INSERT INTO ".self::$table_search. " (whats,wheres,date,latitude,longitude) VALUES ('$what','$where',NOW(),'$user_latitude','$user_longitude')";
		$result = $gdbObj->query($sql);
		
	}
		
}

?>
