<?php
//Details used for website private and not shown here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disp_diary";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>