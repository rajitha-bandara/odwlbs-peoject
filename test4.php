<?php
//$con = mysql_connect('mysql14.000webhost.com','a5048897_admin','admin 123');
//mysql_select_db('a5048897_lbsdb',$con);

$con = mysql_connect('localhost','root','');
mysql_select_db('rating',$con);

$sql = "create table test5(id int primary key,name varchar(25));";
$res=mysql_query($sql,$con);		
echo $res;
echo"<br>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>
<input type="text" name="script-path" size="20" value="<?php echo dirname("../__FILE__"); ?>">  
 <?php echo $_SERVER['HTTP_HOST']; ?> 
     <?php  
    echo getcwd();  
	echo phpversion(); 
	

    ?> 
    
    
     
</body>
</html>