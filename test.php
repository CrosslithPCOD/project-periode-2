<?php
require'header.php';
if (!isset($_SESSION['username'])) {
    echo ''?>
    <h2>If you are an user, please login at <a href="Login.php">our login page</a>. If not, please return to the <a href="Home.php">main page</a></h2>.
    <?php
}else{
    echo ''?>
    	<h2>Profile Check/Update</h2>
<?php }
require "classes/Users.php";
require "classes/dbh.php";
    $user1 = new User();
    $user1->readUser();
		?>
		
		