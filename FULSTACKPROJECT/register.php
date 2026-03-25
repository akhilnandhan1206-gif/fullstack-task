<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success-msg'>Registration Successful!</div>";
    } else {
        $message = "<div class='error-msg'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Student Register</h2>

    <?php echo $message; ?>

    <form method="POST">
        
        <input type="text" name="name" placeholder="Enter Your Name" required>

        <input type="email" name="email" placeholder="Enter Your Email" required>

        <input type="password" name="password" placeholder="Enter Your Password" required>

        <button type="submit">Register</button>

    </form>

    <br>
    <p style="text-align:center;">
        Already have an account? <a href="login.php">Login Here</a>
    </p>

</div>

</body>
</html>