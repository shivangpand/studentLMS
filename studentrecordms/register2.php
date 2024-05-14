<!-- <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentrecorddb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if(isset($_POST['register_btn'])) {
    // Retrieve admin ID from the form
    $admin_id = $_POST['AdminEmail2'];

    // Query to check if admin ID exists in the database
    $sql = "SELECT * FROM tbl_login WHERE AdminEmail = '$admin_id'";
    $result = $conn->query($sql);


    

    if ($result->num_rows > 0) {
        // Admin ID exists in the database, redirect to next page
        header("Location: login.php");
        echo("Registration Successfully");
        exit(); // Ensure script stops executing after redirecting
    } else {
        // Admin ID does not exist in the database, display error message
        echo "Admin ID not found!";
    }
    echo "Registration xx" . $result;
}

$conn->close();
?> -->
