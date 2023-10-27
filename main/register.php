<?php
$host = 'nuh uh';
$dbname = 'nuh uh';
$username = 'nuh uh';
$db_password = 'nuh uh'; 


$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$registration_status = ''; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration_type = $_POST['registration_type'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $company_name = ($_POST['company_name'] ?? ''); 

    // Check if the email or username already exists
    $email_check_query = "SELECT * FROM users WHERE email='$email'";
    $username_check_query = "SELECT * FROM users WHERE username='$username'";

    $email_result = mysqli_query($conn, $email_check_query);
    $username_result = mysqli_query($conn, $username_check_query);

    if (mysqli_num_rows($email_result) > 0) {
        $registration_status = "Email is already in use. Please choose a different email.";
    } elseif (mysqli_num_rows($username_result) > 0) {
        $registration_status = "Username is already in use. Please choose a different username.";
    } else {
        
        $sql = "INSERT INTO users (registration_type, username, email, password, company_name)
                VALUES ('$registration_type', '$username', '$email', '$password', '$company_name')";

        if (mysqli_query($conn, $sql)) {
            $registration_status = "Registration successful!";
            
            header('Location: index.php');
            exit; 
        } else {
            $registration_status = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}


mysqli_close($conn);
?>


<style> 

</style>
    <span>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div class="container">

        <form action="register.php" method="post">
            <label for="registration_type"></label>
            <select name="registration_type" id="registration_type" required>
                <option value="Client">Client</option>
                <option value="Business">Business</option>
            </select>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <div class="business-fields" style="display: none;">
                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name">
            </div>

            <input type="submit" value="Register">
  <a href="index.php" class="continue-button">Continue without Log In</a>
        </form>
    </div>
</body>

    <script>
        const registrationType = document.getElementById("registration_type");
        const businessFields = document.querySelector(".business-fields");

        registrationType.addEventListener("change", function() {
            if (registrationType.value === "Business") {
                businessFields.style.display = "block";
            } else {
                businessFields.style.display = "none";
            }
        });
    </script>
</body>
</html>
</span>