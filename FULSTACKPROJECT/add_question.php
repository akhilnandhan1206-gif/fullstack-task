<?php
include "db.php";

$message = "";

if(isset($_POST['add_question'])) {

    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct = $_POST['correct_option'];

    // Convert selected option number to actual answer text
    if($correct == "1") {
        $correct_answer = $option1;
    }
    elseif($correct == "2") {
        $correct_answer = $option2;
    }
    elseif($correct == "3") {
        $correct_answer = $option3;
    }
    else {
        $correct_answer = $option4;
    }

    $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_option)
            VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer')";

    if(mysqli_query($conn, $sql)) {
        $message = "Question Added Successfully!";
    } else {
        $message = "Error adding question!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Add Question</title>
</head>
<body>

<h2>Add Question</h2>

<?php if($message != "") echo "<p>$message</p>"; ?>

<form method="POST">

Question:<br>
<input type="text" name="question" required><br><br>

Option 1:<br>
<input type="text" name="option1" required><br><br>

Option 2:<br>
<input type="text" name="option2" required><br><br>

Option 3:<br>
<input type="text" name="option3" required><br><br>

Option 4:<br>
<input type="text" name="option4" required><br><br>

Select Correct Option:<br>
<select name="correct_option" required>
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
    <option value="3">Option 3</option>
    <option value="4">Option 4</option>
</select><br><br>

<button type="submit" name="add_question">Add Question</button>

</form>

</body>
</html>