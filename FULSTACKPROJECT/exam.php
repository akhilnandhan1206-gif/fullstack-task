<?php
session_start();
include "db.php";

// Exam duration (10 minutes)
$duration = 600;

// Set timer
if (!isset($_SESSION['end_time'])) {
    $_SESSION['end_time'] = time() + $duration;
}

$remaining_time = $_SESSION['end_time'] - time();

// If time over → redirect
if ($remaining_time <= 0) {
    header("Location: results.php");
    exit;
}

// Fetch questions
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Exam</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            max-width: 900px;
            background: #fff;
            margin: 60px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #timer-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #f44336;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .question-block {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #4CAF50;
        }

        .question-block label {
            display: block;
            margin: 6px 0;
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #45a049;
        }
    </style>
</head>

<body>

<div id="timer-container">
    Time Left: <span id="timer">--:--</span>
</div>

<div class="container">

<h2>Online Exam</h2>

<form id="examForm" method="POST" action="results.php">

<?php
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>

    <div class="question-block">
        <p><b><?php echo $row['question']; ?></b></p>

        <label>
            <input type="radio" name="answer[<?php echo $row['id']; ?>]" value="<?php echo $row['option1']; ?>">
            <?php echo $row['option1']; ?>
        </label>

        <label>
            <input type="radio" name="answer[<?php echo $row['id']; ?>]" value="<?php echo $row['option2']; ?>">
            <?php echo $row['option2']; ?>
        </label>

        <label>
            <input type="radio" name="answer[<?php echo $row['id']; ?>]" value="<?php echo $row['option3']; ?>">
            <?php echo $row['option3']; ?>
        </label>

        <label>
            <input type="radio" name="answer[<?php echo $row['id']; ?>]" value="<?php echo $row['option4']; ?>">
            <?php echo $row['option4']; ?>
        </label>
    </div>

<?php
    }
} else {
    echo "No questions found!";
}
?>

<input type="submit" value="Submit Exam">

</form>

</div>

<script>
let timeLeft = <?php echo $remaining_time; ?>;

function startTimer() {
    const timerDisplay = document.getElementById('timer');

    const countdown = setInterval(function() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        seconds = seconds < 10 ? '0' + seconds : seconds;
        timerDisplay.innerHTML = minutes + ":" + seconds;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            alert("Time is up! Submitting your answers.");
            document.getElementById('examForm').submit();
        }

        timeLeft--;
    }, 1000);
}

window.onload = startTimer;
</script>

</body>
</html>