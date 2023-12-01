<?php
SESSION_START();

if (isset($_SESSION['theme'])) {
    $_SESSION['theme'] = $_POST['theme'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="lamborghini.ico">
    <link href="CSS/styles.css" type="text/css" rel="stylesheet">
    <script src="JavaScript/script.js"></script>
    <script>
    <?php
    if (isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark') {
        echo 'document.body.classList.add("dark-mode");';
    }
    ?>
</script>
</head>
<body>

    <nav id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {
            echo "<li><a href='createCar.php'>Create Car</a></li>";
            echo "<li><a href='readAllUsers.php'>User List</a></li>";
            }
            ?>
            <li><a href="readCar.php">Lamborghini Models</a></li>
            <?php 
            if (!isset($_SESSION['email'])) {
                echo "<li><a href='createUser.php'>Register</a></li>";
                echo "<li><a href='login.php'>Login</a></li>";
            } else {
                echo "<li><a href='readUser.php'>User Email: " . $_SESSION["email"] . "</a></li>";
                if ($_SESSION['role'] == '2') {
                    echo "<li>Client</li>";
                    echo "<li><a href='readAppointment.php'>My Appointment</a></li>";
                } else if ($_SESSION['role'] == '1') {
                    echo "<li>Admin</li>";
                    echo "<li><a href='readAllAppointments.php'>All Appointments</a></li>";
                } else {
                    echo "<li>Owner</li>";
                    echo "<li><a href='readAllAppointments.php'>All Appointments</a></li>";
                }
                echo "<li><a href='readUser.php'>Account info</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
            }
            ?>
        </ul>
    </nav>
    <main class="dark">