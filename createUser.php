<?php
require 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "classes/Users.php";	    // connects to the OOP file
    require "classes/dbh.php";	// connects to the database
    
    //  -------------------------
    $id = NULL;	         // auto incremented; not an input value
    $firstname =         $_POST["firstname"];
    $lastname =          $_POST["lastname"];
    $nohashpassword =    $_POST["password"];
    $password =          password_hash($nohashpassword, PASSWORD_DEFAULT); // hashes the password (
    $email =             $_POST["email"];
    $phone =             $_POST["phone"];
    
    // maken object ---------------------------------------------------
    $user = new User($firstname, $lastname, $password, $email, $phone); // creates the object
    $user->createUser();

	?>
	<main>
		<p>Registration successful.</p>
		<br>
		<a class="button" href='readUser.php'>Inspect data</a>
	</main>
	<?php
}
?>
	<h1>Register</h1>
	<p>
		Please fill in this form to create an account.
	</p>
	<hr>
<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
	<div>
		<label>Firstname *</label>
		<br>
		<input placeholder="Enter your Firstname" type="text" name="firstname" required="">
		<br>
	</div>
	<div>
		<label>Lastname *</label>
		<br>
		<input placeholder="Enter your Lastname" type="text" name="lastname" required="">
		<br>
	</div>
	<br>
	<div>
		<label>Password *</label>
		<br>
		<input placeholder="Enter your Password" type="password" name="password" required="">
	</div>
	<br>
	<div>
		<label for="email">Email *</label>
		<br>
		<input placeholder="Enter your Email" type="email" id="email" name="email" required="">
	</div>
	<br>
	<div>
		<label>Phone *</label>
		<br>
		<input placeholder="Enter your Mobile Number" type="tel" name="phone" required="">
	</div>
	<br>
	<div>
	<button type="submit" value="Register">Create</button>
	</div>
</form>
<br>
<a class="button" href="login.php">Have an account? Login here!</a>