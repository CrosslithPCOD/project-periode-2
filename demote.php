<?php
include "header.php";
// Check if the user is logged in and has admin privileges
if (isset($_SESSION['email']) && $_SESSION['role'] == '0') {
    try {
    // Check if the user_id parameter is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Include the necessary files
        include "classes/dbh.php";
        include "classes/Users.php";

        // Create a User object
        $user = new User(null, null, null, null, null, null, null, $conn);

        // Update the user's role
        $user->updateUserRole($id, 2);

        // Redirect back 
        ?>
        <main class="dark">
            <p>User demoted.</p>
            <br>
            <a class="button" href='readAllUsers.php'>Back to user list</a>
        <?php
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
}
}
else {
    echo "<p>You don't have permission to access this page.</p><br>";
    echo "<a class='button' href='index.php'>Back to home</a>";
}
?>
