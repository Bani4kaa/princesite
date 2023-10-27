<?php
$host = 'soon';
$dbname = 'soon';
$username = 'soon';
$password = 'soon';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $registration_type = $_POST['registration_type'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    if ($registration_type === 'Client') {
        $stmt = $pdo->prepare("INSERT INTO clients (username, email, password) VALUES (:username, :email, :password)");
    } elseif ($registration_type === 'Business') {
        $company_name = $_POST['company_name'];
        $stmt = $pdo->prepare("INSERT INTO businesses (company_name, username, email, password) VALUES (:company_name, :username, :email, :password)");
        $stmt->bindParam(':company_name', $company_name);
    }

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    echo "Registration successful. You can now <a href='login.html'>login</a>.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="registration_type">Select Registration Type:</label>
        <select name="registration_type" id="registration_type" required>
            <option value="Client">Client</option>
            <option value="Business">Business</option>
        </select><br>
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>

        <div class="business-fields" style="display: none;">
            Company Name: <input type="text" name="company_name"><br>
        </div>

        <input type="submit" value="Register">
    </form>

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
