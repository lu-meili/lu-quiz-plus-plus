<?php

session_start();
session_destroy();

include 'header.php';

?>


<div class="container">

    <h4>
        Click below to begin quizzing!
    </h4>
    <br>
    <form action="question.php" method="post">
        <button type="submit" class="btn btn-warning info buttons">start</button>
        <br>
    </form>
</div>


<?php

include 'footer.php';

?>