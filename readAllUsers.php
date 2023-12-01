<?php
include "header.php";
// Check permissions
if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {
?> 

<head>
    <title>User Listing</title>
</head>
<body>
    <h1>Users</h1>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>phone</th>
                <th>created_at</th>
                <th>role</th>
                <?php if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1')) {
                 echo "<th>Action</th>";
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // database connection file
            include "classes/dbh.php";

            // Include User class file
            include "classes/Users.php";

            try {
                // create a new User object
                $user = new User(null, null, null, null, null, null, null, $conn);

                // Call the read function
                $users = $user->readUsers();

                // Loop through the user data and generate table rows
                foreach ($users as $user) {
                    echo "<tr>
                    <td>" . $user['id'] . "</td>
                    <td>" . $user['firstname'] . "</td>
                    <td>" . $user['lastname'] . "</td>
                    <td>" . $user['email'] . "</td>
                    <td>" . $user['phone'] . "</td>
                    <td>" . $user['createdat'] . "</td>
                    <td>" . $user['role'] . "</td>
                    <td>";
                    if (isset($_SESSION['email']) && ($_SESSION['role'] == '0' || $_SESSION['role'] == '1') && $user['role'] == '2') {
                        // promote to admin
                        echo '<a href="promote.php?id=' . $user['id'] . '"><p>Promote to Admin</p></a>';
                    }
                    else if (isset($_SESSION['email']) && $_SESSION['role'] == '0' && $user['role'] == '1') {
                        // demote to user
                        echo '<a href="demote.php?id=' . $user['id'] . '"><p>Demote to User</p></a>';
                    }
                    else {
                        echo '';
                    }
                    echo "</td>
                    </tr>";
                }
            } catch (Exception $e) {
                // Handle exceptions
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<p>You don't have permission to access this page.</p><br>";
            echo "<a class='button' href='index.php'>Back to home</a>";
        }