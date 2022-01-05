<?php
include("connect.php") ;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$room = $_GET['room'];
$temp = $_GET['temp'];
$humi = $_GET['humi'];
$sql = "INSERT INTO dht22(room,temp,humi) VALUES ($room,$temp,$humi);";

if ($conn->query($sql) === TRUE) {
    echo "save OK";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
