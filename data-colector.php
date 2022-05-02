<?php session_start();

if (isset($_POST['lastQuestionIndex'])) {
    
    // get the inderx (string) of the last question
    $lastQuestionIndex = $_POST['lastQuestionIndex']; // ohne intavl()

    // add and create the key for that qustion
    $questionKey = 'q' . $lastQuestionIndex;

    //achieved points

    $achievedPoints = 0;

    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'a-')) {
            // same as: $achievedPoints = $achievedPoints +intval($value);
            $achievedPoints += intval($value);
        }
    }

    //DEVONLY: echo "achievedPoints = $achievedPoints<br>";

    // make sure athe list of all achieved points exists in the $_SESSION.
    if (!isset($SESSION['achievedPointsList'])) {
        $_SESSION['achievedPointsList'] = array();
    }

    $_SESSION['achievedPointsList'][$questionKey] = $achievedPoints;

    //max points
    $maxPoints = intval($_POST['maxPoints']);

    //make sure ths list of all max points exists in the $_SESSION.
    if (!isset($_SESSION['maxPointsList'])) {
        $_SESSION['maxPointsList'] = array();
    }

    $_SESSION['maxPointsList'][$questionKey] = $maxPoints;
}


   //print "<pre>";
   //print_r($_POST);
   //print "</pre>";
   
?>
