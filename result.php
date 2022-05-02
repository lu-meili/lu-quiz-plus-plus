<?php

include 'data-colector.php';

//get the lists with the achieved and maximum points (listed per question).
if (isset($_SESSION['achievedPointsList'])) {
    $achievedPointsList = $_SESSION['achievedPointsList'];
} else {
    //lands here if result.php is opended in the browser before visiting any question before.
    $achievedPointsList = array();
}

if (isset($_SESSION['maxPointsList'])) {
    $maxPointsList = $_SESSION['maxPointsList'];
} else {
    //lands here if result.php is opended in the browser before visiting any question before.
    $maxPointsList = array();
}

//get total of achieved points.
$total = 0;

foreach ($achievedPointsList as $key => $value) {
    $total += $value; // same as: $maxTotal = $maxTotal + $value;
}

//get total of maximum points.
$maxTotal = 0;

foreach ($maxPointsList as $key => $value) {
    $maxTotal += $value; // same as: $maxTotal = $maxTotal + $value;
}

//depending on the achieved points, set a feedback exclamation
if ($total / $maxTotal >= 0.8) {
    $exclamation = "Great";
} else if ($total / $maxTotal >= 0.4) {
    $exclamation = "Good";
} else {
    $exclamation = "Study more";
}
?>

<html>

<head>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:fuchsia; text-align:left;"></body>
<div class="container bg-warning mt-3">
    
<h4><?php echo $exclamation; ?>, you got <?php echo $total; ?> of <?php echo $maxTotal; ?> points!</h4>
<p class="warning"></p>
</form>

<form action="index.php" method="post">
    <input type="submit" class='btn btn-info' value="again">
    <p class="warning"></p>
</form>

<?php include 'footer.php'; ?>