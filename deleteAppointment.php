<?php
include "header.php";

// include class and db connection
require_once "classes/dbh.php";
require_once "classes/appointment.php";

// check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $appointment = new Appointment($appointmentId, null, null, null, null, null, null, $conn);
    $existingAppointment = $appointment->readById();

    if ($existingAppointment) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
            $appointment->delete();

            ?>
            <p>Appointment deleted successfully.</p> <br>
            <a class="button" href='index.php'>Back to home</a>
            <?php
            exit();
        }
    }
    else {
        echo "<p>Appointment record not found.</p>";
    }
    ?>
    <title>Lamborghini - Delete appointment</title>
        <h1>Cancel appointment</h1>
        <form action="" method="POST">
            <p>Are you sure you want to cancel this appointment?</p>
            <a class="button" href="readCar.php">No</a>
            <br>
            <button type="submit" name="delete">Cancel appointment</button>
        </form>
        <?php
}
else {
    echo "<p>Appointment ID not provided.</p>";
}