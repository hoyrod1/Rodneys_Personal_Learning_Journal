<?php 

$servername = "localhost";
$username   = "root";
$password = "";
$dbname   = "personal_learning_journal";

try 
{
	$db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connection Successful!!!";	
} catch (Exception $e) 
{
	echo "Connection Failed. Error detail: " . $e->getMessage();	
}