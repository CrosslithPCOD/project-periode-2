<?php
include "header.php";
// Check permissions
if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {

require_once "classes/dbh.php";
require_once "classes/car.php";

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    // Retrieve the car ID from the URL parameter
    $carId = $_GET['id'];

    // Create a new Car object and fetch the existing car record
    $car = new Car(null, null, null, null, null, null, null, $carId, $conn);
    $existingCar = $car->readById();

    // Check if the car record exists
    if ($existingCar) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
            // Check if the delete button was clicked
            
            // Call the delete method to delete the car record
            $car->delete();

            // Redirect to a page after deletion
            ?>
            <p>Car record deleted successfully.</p> <br>
            <a class="button" href='readCar.php'>Back to car list</a>
            <?php
            exit();
        }
    } else {
        echo "Car record not found.";
    }
} else {
    echo "Car ID not provided.";
}
?>
    <title>Delete Car Record</title>
        <h1>Delete Car Record</h1>
        <form action="" method="post"   >
            <p>Are you sure you want to delete this car record?</p>
            <a class="button" href="readCar.php">Cancel</a>
            <br>
            <button type="submit" name="delete">Delete Car</button>
        </form>
<?php
} else {
    echo "<p>You don't have permission to access this page.</p><br>";
    echo "<a class='button' href='index.php'>Back to home</a>";
}