<?php
require 'header.php';
require "classes/Users.php";
require "classes/dbh.php";	// connects to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  -------------------------
    $id =                $_POST["id"];
    $firstname =         $_POST["firstname"];
    $lastname =          $_POST["lastname"];
    $nohashpassword =    $_POST["password"];
    $password =          password_hash($nohashpassword, PASSWORD_DEFAULT); // hashes the password
    $email =             $_POST["email"];
    $phone =             $_POST["phone"];
    
    // maken object ---------------------------------------------------
    $user = new User($firstname, $lastname, $password, $email, $phone, $id, $conn); // creates the object
    $user->updateUser($id);
}

if (!isset($_SESSION['email'])) {
    echo '<h1>If you are a user, please login at <a href="Login.php">our login page</a>. If not, please return to the <a href="Home.php">main page</a></h1>.';
} else {
    echo '<h1>Profile Check/Update</h1>';
    
    $user = new User();
    $user->readUser();
}

require 'footer.php';
?>