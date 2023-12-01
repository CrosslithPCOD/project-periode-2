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

        try {
            // Create a new Appointment object
            $appointment = new Appointment(null, null, null, null, null, null, null, $conn);

            // set user name for which you want to see the appointment of
            $user_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
            $appointment->setUserName($user_name);

            // Call the read function
            $appointments = $appointment->read();

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
                echo "<td><img id='img' src='" . $appointment['image'] . "'></td>";
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