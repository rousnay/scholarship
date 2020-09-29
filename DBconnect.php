<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scholarship";

$conn = new mysqli ($servername, $username, $password);


if ($conn->connect_error) {
die ("Connection Eailed: " . $conn->connect_error);

}else{
mysqli_select_db($conn, $dbname);
}
?>