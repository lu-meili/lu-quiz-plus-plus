<?php

include 'data-colector.php';
include 'db.php';


//evaluate data in $_POST variable.
$currentQuestionIndex = 0;

if (isset($_POST['lastQuestionIndex'])) {
    // Get data from last post.
    $lastQuestionIndex = $_POST['lastQuestionIndex'];

    if (isset($_POST['nextQuestionIndex'])) {
        // Define the index number of the next question.
        $currentQuestionIndex = $_POST['nextQuestionIndex'];
    }
}

// check if $_SESSION['questions']) exists
if (isset($_SESSION['questions'])) {
    //echo 'questions data EXISTS in session
    $questions = $_SESSION['questions'];
} else {
    //echo 'questions data does nots EXISTS in session. ,br>';

    //get quiz data using php/db.php...
    $questions = getQuestions();

    //and save that data in $_SESSION
    $_SESSION['questions'] = $questions;
}

//echo '<pre>';
//print_r($_SESSION['questions']);
//echo '</pre>';

?>

<html>

<head>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:fuchsia; text-align:left;"></body>
<div class="container bg-warning mt-3">
    <h2>Quiz ++</h2><br>

    <h4>Frage <?php echo $questions[$currentQuestionIndex]['ID']; ?></h4>
    <p> <?php echo $questions[$currentQuestionIndex]['Text']; ?></p>

    <form <?php if ($currentQuestionIndex + 1 >= count($questions)) echo 'action="result.php" '; ?> method="post">


        <?php
        $answers = $questions[$currentQuestionIndex]['answers'];
        //Type e 'Type' ao invés de $isMultipleChoice
        $Type = $questions[$currentQuestionIndex]['Type'];
        $maxPoints = 0;

        for ($a = 0; $a < count($answers); $a++) {
            echo '<div class="form-check">';
            $isCorrect = $answers[$a]['IsCorrectAnswer'];
            //IsCorrectAnswer ao invés de isCorrect

            //Type e MULTIPLE ao invés de $isMultipleChoice e 1
            if ($Type == 'MULTIPLE') {
                //Multiple Choice (checkbox)
                echo '<input class="form-check-input" type="checkbox" name="a-' . $a . '"value="' . $isCorrect . '" id=i-' . $a . '">';
            } else {
                //Single  Choice (radio)
                echo '<input class="form-check-input" type="radio" name="a-0" value="' . $isCorrect . '" id="i-' . $a . '">';
            }

            $maxPoints += $isCorrect; // same as:$maxPoints = $maxPoints + $isCorrect;

            echo '<label class="form-check-label" for="i-' . $a . '">';
            echo $answers[$a]['Text']; //a is for answer and 'Text' is the named of the column in MyAdminPHP
            echo '</label>';
            echo '</div>';
        }
        ?>

        <!--  hidden fields-->
        <input type="hidden" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
        <input type="hidden" name="nextQuestionIndex" value="<?php echo $currentQuestionIndex + 1; ?>">
        <input type="hidden" name="maxPoints" value="<?php echo $maxPoints; ?>">
        <!-- end hidden fields-->

        <input type='submit' class='btn btn-info' value='next'>
    </form>


    <?php include 'footer.php'; ?>
    
</body>
</html>