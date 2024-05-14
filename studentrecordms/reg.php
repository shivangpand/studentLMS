<?php
// Assuming you have already established a database connection

// Query to fetch admin email from the database
$query = "SELECT AdminEmail FROM tbl_login WHERE id = 1"; // Assuming 'id = 1' is the admin record you want
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $adminemail = $row['adminemail'];
} else {
    // Handle the case if fetching admin email fails
    $admin_email = ""; // Set a default value if needed
}

// Close the database connection
mysqli_close($connection);
?>
