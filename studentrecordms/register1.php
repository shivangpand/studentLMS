
<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentrecorddb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data, check if they are set
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$username = isset($_POST['loginid']) ? $_POST['loginid'] : '';
$email = isset($_POST['adminemail']) ? $_POST['adminemail'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if loginid already exists
$stmt = $conn->prepare("SELECT * FROM tbl_login WHERE loginid = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Username already exists. Please choose a different one.";
} else {
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO tbl_login (FullName, loginid, AdminEmail, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);


if($stmt->execute()) {
echo "<div style='font-size: 24px; text-align: center;'>"; // Make the message bigger and center it
echo "Registration successful!";
echo "</div>";
echo "<div style='text-align: center;'>"; // Center the button
echo "<button class='login-button' style='font-size: 18px;' onclick=\"location.href='login.php'\">Login</button>"; // Make the button bigger
echo "</div>";
} else {
    echo "Error: " . $stmt->error;
}
}

// Check if form is submitted
if(isset($_POST['register_btn'])) {
    // Retrieve admin ID from the form
    $admin_id = $_POST['AdminEmail2'];

    // Query to check if admin ID exists in the database
    $sql = "SELECT * FROM tbl_login WHERE AdminEmail = '$admin_id'";
    $result = $conn->query($sql);

    if($stmt->execute()) {
        echo "<div style='font-size: 24px; text-align: center;'>"; // Make the message bigger and center it
        echo "Registration successful!";
        echo "</div>";
        echo "<div style='text-align: center;'>"; // Center the button
        echo "<button class='login-button' style='font-size: 18px;' onclick=\"location.href='login.php'\">Login</button>"; // Make the button bigger
        echo "</div>";
        } else {
            echo "Error: " . $stmt->error;
        }
        }

    

    //if ($result->num_rows > 0) {
        // Admin ID exists in the database, redirect to next page
       // header("Location: login.php");
        
        //exit(); // Ensure script stops executing after redirecting
   // } else {
        // Admin ID does not exist in the database, display error message
       // echo "Admin ID not found!";
  //  }
//}
$conn->close();
?>
<style>
  
  

  
</style>
