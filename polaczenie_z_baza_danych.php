<?php
$servername = "localhost";
$username = "root";
$database = "wypożyczalnia_samochodów_z_serwisem";

$conn = new mysqli($servername, $username,"", $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully";
?>