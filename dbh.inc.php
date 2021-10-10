<?php

//this is the database handler

//if the server is different, like online server
//change username and password for online server
$servername = "db.gregfairbanks.net";
$dbUsername = "SMU";
$dbPassword = "SMUAccount";
$dbName = "SMU";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn)
{
	die("Connection failed: ".mysqli_connect_error());
}
