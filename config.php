<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database="gamezone";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

$dir = dirname("http://localhost/gameworld/game-admin/img");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>