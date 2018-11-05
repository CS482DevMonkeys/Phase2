<?php
#Database connection
$servername = "dbclass.cs.nmsu.edu:3306";
$username = "dbaldwin";
$password = "44kx-7ww";
$dbname = "cs482502fa18_dbaldwin";
//hostname: dbclass.cs.nmsu.edu
//databasename :
//dbclass.cs.nmsu.edu
// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {	
    die("Connection failed: " . mysqli_connect_error());
}
//echo ("<div style='padding:20px;'>Connected successfully</div>");
//mysqli_close($GLOBALS['conn']);