<?php
session_start();
date_default_timezone_set('Asia/Manila');
$servername = "localhost";
$username = "purecadmin";
$password = "ruffycastro09";
$database = "purec";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>