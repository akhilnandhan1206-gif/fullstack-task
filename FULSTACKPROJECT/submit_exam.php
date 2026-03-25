<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$score = 0;

// Get all questions
$query = mysqli_query($conn, "SELECT * FROM questions");

while ($row = mysqli_fetch_assoc($query)) {

    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];

    if (isset($_POST['answer'][$question_id])) {
        if ($_POST['answer'][$question_id] == $correct_answer) {
            $score++;
        }
    }
}

// Save result
mysqli_query($conn, "INSERT INTO results (user_id, score) 
                     VALUES ('$user_id', '$score')");

// Redirect to result page
header("Location: result.php");
exit();
?>