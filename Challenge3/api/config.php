<?php
function getDB() {
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="ayabonga";
	$dbname="challenge3db";
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>