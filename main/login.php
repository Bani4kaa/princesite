<?php
$host = 'nuh uh';
$dbname = 'nuh uh';
$username = 'nuh uh';
$db_password = 'nuh uh'; 


$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Check the database for user authentication
    $login_query = "SELECT * FROM users WHERE username='$input_username' AND password='$input_password'";
    $login_result = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_result) > 0) {
        // User authenticated successfully
        $_SESSION['username'] = $input_username;
        header('Location: index.php'); // Redirect to a welcome page after login
        exit;
    } else {
        $login_status = "Invalid username or password. Please try again.";
    }
}

mysqli_close($conn);
?>
<span>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <?php echo $login_status; ?>

            <input type="submit" value="Log In">
        </form>

        <a href="register.php" class="register-button">Register</a>
    </div>
</body>
</html></span>
