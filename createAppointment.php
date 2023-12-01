<?php
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Require the car class definition and database connection
    require_once 'classes/dbh.php';
    require_once 'classes/appointment.php';

    // Retrieve form data
    $user_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    $user_email = $_SESSION['email'];
    $car_model = $_GET['model'];
    $car_year = $_GET['year'];
    $car_image = $_GET['image'];
    $appointment_date = $_POST['appointment_date'];
    

    // Create a new car object
    $appointment = new Appointment(null, $user_name, $user_email, $car_model, $car_year, $car_image, $appointment_date, $conn);

    // Call the create method to insert the car record into the database
    $appointment->create();

    // Redirect to a success page or display a success message
    ?>
    <p>Appointment scheduled!</p>
    <br>
    <a class="button" href="readAppointment.php">Check your appointment</a>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamborghini - Create</title>
</head>
    <body>
        <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
            <h1>Schedule appointment</h1>
            <br>
            <label for="appointment_date"> date:</label>
            <input type="datetime-local" id="appointment_date" name="appointment_date" required><br>

            
            <button type="submit" value="Create Appointment">Schedule Appointment</button>
        </form>

    </body>
</html>