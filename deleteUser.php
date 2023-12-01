<?php
require 'header.php';
require "classes/dbh.php";	// connects to the database
require "classes/Users.php";

if (!isset($_SESSION['email'])) {
    echo '<h1>If you are a user, please login at <a href="Login.php">our login page</a>. If not, please return to the <a href="Home.php">main page</a></h1>.';
} else {
    $email = $_SESSION["email"];
    
    $user =  new User();
    $user->deleteUser($email);
}

require 'footer.php';
?>