<?php
$host ="localhost";
$dbname ="rahul";
$username ="root";
$password ="";

$conn =($host, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed" .$conn->connect_error);
}

if($_SERVER ["REQUEST_METHOD"] =="POST"){
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("INSERT INTO mech (email, name, phone, password) VALUES(?,?,?,?)");

    if($stmt === false){
        die("prepare failed".$conn->error);
    }

    $stmt->bind_param("ssss", $email, $name, $phone, $password);

    if ($stmt->execute()) {
        echo "Submission successful!";
    } else {
        echo "Failed to insert data: " . $stmt->error;
    }

    $stmt->close();



}
$conn->close();
?>