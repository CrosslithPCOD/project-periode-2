<?php
require 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "classes/Users.php";    // connects to the User class
    require "classes/dbh.php";      // connects to the database

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch the user by email from the database
    $user = User::getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables and redirect
        //session_start();
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user['role'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];

        header("location: index.php");
    } else {
        // Invalid login credentials
        ?>
        <main>
            <p>Invalid email or password.</p>
            <br>
        </main>
        <?php
    }
}
?>

    <h1>Login</h1>
    <p>
        Please fill in this form to login.
    </p>
    <hr>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
        <div>
            <label>Email *</label>
            <br>
            <input placeholder="Enter your Email" type="email" name="email" required="">
        </div>
        <br>
        <div>
            <label>Password *</label>
            <br>
            <input placeholder="Enter your Password" type="password" name="password" required="">
        </div>
        <br>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>