
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
$admin_id = isset($_POST['AdminEmail2']) ? $_POST['AdminEmail2'] : ''; 
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
    $defaultId= 'admin';
    $stmt = $conn->prepare("SELECT * FROM tbl_login WHERE loginid = ?");
    $stmt->bind_param("s", $defaultId);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $key;
    while ($row = mysqli_fetch_assoc($result1)) {
        // Loop through each row and echo all fields and their values except the password field
        foreach ($row as $field => $value) {
            if ($field == 'password') { // Exclude the password field
                $key = $value;
            }
        }
        echo "<br>"; // Add a line break between each row
    }
    if($key !== $admin_id){
        echo "Unauthorized Attempted to Registration.";
    }else{
            // Insert data into database
    $stmt = $conn->prepare("INSERT INTO tbl_login (FullName, loginid, AdminEmail, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);


    if($stmt->execute()) {
        echo "<div style='font-size: 24px; text-align: center; margin-bottom: 20px;'>"; // Make the message bigger, center it, and add margin
        echo "Registration successful!";
        echo "</div>";
        echo "<div style='text-align: center;'>"; // Center the button
        echo "<button class='login-button' style='font-size: 18px; padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer; transition: background-color 0.3s;' onclick=\"location.href='login.php'\">Login</button>"; // Make the button bigger and add inline styling
        echo "</div>";
        
    } else {
        echo "Error: " . $stmt->error;
    }
    }
}

// Check if form is submitted
// if(isset($_POST['register_btn'])) {
//     // Retrieve admin ID from the form
//     $admin_id = $_POST['AdminEmail2'];

//     // Query to check if admin ID exists in the database
//     $sql = "SELECT * FROM tbl_login WHERE AdminEmail = '$admin_id'";
//     $result = $conn->query($sql);

//     if($stmt->execute()) {
//         echo "<div style='font-size: 24px; text-align: center;'>"; // Make the message bigger and center it
//         echo "Registration successful!";
//         echo "</div>";
//         echo "<div style='text-align: center;'>"; // Center the button
//         echo "<button class='login-button' style='font-size: 18px;' onclick=\"location.href='login.php'\">Login</button>"; // Make the button bigger
//         echo "</div>";
//         } else {
//             echo "Error: " . $stmt->error;
//         }
//         }

    

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
  .registration-message {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px; /* Add some spacing below the message */
}

.button-container {
    text-align: center;
}

.login-button {
    font-size: 18px;
    padding: 10px 20px; /* Add padding to make the button bigger */
    border-radius: 5px; /* Round the button corners */
    background-color: #4CAF50; /* Green background color */
    color: white; /* White text color */
    border: none; /* Remove border */
    cursor: pointer; /* Add cursor pointer on hover */
    transition: background-color 0.3s; /* Smooth transition for background color */
}

.login-button:hover {
    background-color: #45a049; /* Darker green on hover */
}
  

  
</style>
