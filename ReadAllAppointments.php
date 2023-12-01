<?php
include "header.php";
?>

<title>Lamborghini - Appointment</title>
<h1>Appointment details</h1>

        <?php
        // database connection file
        include "classes/dbh.php";

        // Include Appointment class file
        include "classes/appointment.php";

        // check permissions
        if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {

        try {
            // Create a new Appointment object
            $appointment = new Appointment(null, null, null, null, null, null, null, $conn);

            // Call the read function
            $appointments = $appointment->readAll();

            if ($appointments) {
                ?>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($appointments as $appointment) {
                echo "<tr>";
                echo "<td>" . $appointment['user_name'] . "</td>";
                echo "<td>" . $appointment['user_email'] . "</td>";
                echo "<td>" . $appointment['model'] . "</td>";
                echo "<td>" . $appointment['year'] . "</td>";
                echo "<td><img id='img2' src='" . $appointment['image'] . "'></td>";
                echo "<td>" . $appointment['appointment_date'] . "</td>";
                echo '<td><a href="deleteAppointment.php?id=' . $appointment['id'] . '"><p>Delete</p></a></td>';
                echo "</tr>";
                    }
            }
            else{
                echo "<p>No appointment scheduled</p>";
                echo "<br>";
                echo "<a class='button' href='readCar.php'>Schedule an appointment</a>";
            }
        } catch (Exception $e) {
            echo "<p>Error: </p>" . $e->getMessage();
        }
        ?>
    </tbody>
</table>
<?php
}
else {
    echo "<p>You don't have permission to view this page</p>";
    echo "<br>";
    echo "<a class='button' href='readCar.php'>Schedule an appointment</a>";
}