<?php
include 'header.php';
?>
<head>
    <title>Lamborghini - Car List</title>
</head>
<body>
    <h1>Car List</h1>
    <?php 
    if (!isset($_SESSION["email"])){
        echo '<a href="login.php"><p>Login here to schedule an appointment</p></a>';
    }
    ?>
        <table>
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
    <?php 
    if (isset($_SESSION["email"])){
        echo '<th>Action</th>';
    }
    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // database connection file
                include "classes/dbh.php";

                // Include Car class file
                include "classes/car.php";

                try {
                    // Create a new Car object
                    $car = new Car(null, null, null, null, null, null, null, null, $conn);

                    // Call the read function
                    $cars = $car->read();

                    // Loop through the car data and generate table rows
                    foreach ($cars as $car) {
                        echo "<tr>";
                        echo "<td>" . $car['make'] . "</td>";
                        echo "<td>" . $car['model'] . "</td>";
                        echo "<td>" . $car['year'] . "</td>";
                        echo "<td>" . $car['color'] . "</td>";
                        echo "<td> €" . $car['price'] . ",-</td>";
                        echo "<td>" . $car['description'] . "</td>";
                        echo "<td><img id='img' src='" . $car['image'] . "'></td>";
                        
                        // Add Update and Delete buttons with links to appropriate actions
                        if (isset($_SESSION['email'])){
                            echo '<td>';
                            if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {
                                echo '<a href="updateCar.php?id=' . $car['id'] . '"><p>Update</p></a>';
                                echo ' | ';
                                echo '<a href="deleteCar.php?id=' . $car['id'] . '"><p>Delete</p></a>';
                            }
                            else if (isset($_SESSION['email']) && $_SESSION['role'] == '2') {
                                echo '<a href="createAppointment.php?model=' . $car['model'] . '&year=' . $car['year'] . '&image=' . $car['image'] . '">
                                      <p>Schedule appointment</p></a>';
                            }
                            echo '</td>';
                        }
                        
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    
</body>
</html>
