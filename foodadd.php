<?php
include("connect.php") ;

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cricket";

// Create connection
//$conn = new mysqli($servername, $username,$password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$room = $_GET['room'];
$amount = $_GET['amount'];
$sql = "INSERT INTO food(room,amount) VALUES ($room,$amount);";

if ($conn->query($sql) === TRUE) {
    echo "save OK";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
