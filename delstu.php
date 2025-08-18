<?php
$email = $_GET["email"];
$server   = "localhost";
$user = "root";
$pass = "";
$db = "lms";

try {
    $sqlconn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $sqlconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use a prepared statement with a named parameter
    $stmt = $sqlconn->prepare("DELETE FROM userlogin WHERE email = :email");
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Student data deleted.";
        header("Refresh:1, URL=dashadmin.php");
    } else {
        echo "Error: Unable to delete the record.";
    }
} catch (PDOException $e) {
	error_log("Error: " . $e->getMessage()", 0);
    echo "Error !!!";
}

$sqlconn = null; // Close the connection
