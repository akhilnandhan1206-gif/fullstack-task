<?php
session_start();
include("db.php");

// If no answers submitted
if(!isset($_POST['answer'])) {
    echo "<h2 style='text-align:center;'>No answers submitted!</h2>";
    exit();
}

// Clear timer for next attempt
unset($_SESSION['end_time']);

$answers = $_POST['answer'];
$score = 0;
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Result</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #4CAF50;
            color: white;
        }

        .correct {
            color: green;
            font-weight: bold;
        }

        .wrong {
            color: red;
            font-weight: bold;
        }

        .score-box {
            text-align: center;
            font-size: 22px;
            margin-top: 20px;
        }

        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #1976D2;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Exam Result</h2>

<table>
<tr>
    <th>Question</th>
    <th>Your Answer</th>
    <th>Correct Answer</th>
</tr>

<?php
foreach($answers as $question_id => $selected_answer) {

    $query = "SELECT question, correct_option FROM questions WHERE id = $question_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $total++;

    $isCorrect = ($row['correct_option'] == $selected_answer);

    if($isCorrect) {
        $score++;
    }

    echo "<tr>";
    echo "<td>".$row['question']."</td>";
    echo "<td class='".($isCorrect ? "correct" : "wrong")."'>".$selected_answer."</td>";
    echo "<td>".$row['correct_option']."</td>";
    echo "</tr>";
}
?>

</table>

<div class="score-box">
    Your Score: <b><?php echo $score . " / " . $total; ?></b>
</div>

<a href="exam.php" class="btn">Take Exam Again</a>

</div>

</body>
</html>