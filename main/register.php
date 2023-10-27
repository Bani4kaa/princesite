<?php
$host = 'nodes1.thundernodes.tech:3306';
$dbname = 's168_register';
$username = 'u168_sVqVQkC5p9';
$db_password = 'l@6OjExWjY+RcqVbOub.JCk!'; // Use a different variable for database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $registration_type = $_POST['registration_type'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Use a different variable for hashed password

    if ($registration_type === 'Client') {
        $stmt = $pdo->prepare("INSERT INTO clients (username, email, password) VALUES (:username, :email, :password)");
    } elseif ($registration_type === 'Business') {
        $company_name = $_POST['company_name'];
        $stmt = $pdo->prepare("INSERT INTO businesses (company_name, username, email, password) VALUES (:company_name, :username, :email, :password)");
        $stmt->bindParam(':company_name', $company_name);
    }

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password); // Use the hashed password
    $stmt->execute();

    echo "Registration successful. You can now <a href='login.html'>login</a>.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
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