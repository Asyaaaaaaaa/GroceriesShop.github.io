<?php
$servername = "sql12.freesqldatabase.com";
$username = "sql12714414";
$password = "KvnNxXvPDY";
$dbname = "sql12714414";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
