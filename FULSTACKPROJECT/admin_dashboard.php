<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Welcome Admin</h2>

    <a href="add_question.php">Add Question</a><br><br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>