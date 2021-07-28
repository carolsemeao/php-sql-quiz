<?php
    // config include
    include '../config.php';
    

    // Get quiz id and register it in the session
    if(isset($_GET['qid'])){
        $quizID = $_GET['qid'];
    }
    else{
        $quizID = 1;
    }

    $_SESSION['quizID'] = $quizID;
?>
<?php include 'header.php'; ?>
    <section class="thx">
        <div class="container-thx">
            <img src="../images/wand.gif" class="wand" alt="">
            <h1>Thanks for submitting your Feedback!</h1>
            <h3>We take every feedback seriously and will constantly update the quiz!</h3>
            <form action="/projects/QuizCaro/templates/introduction.php?qid=1" method="post">
                <button class ="bck-btn">Back To Main Menu</button>
            </form>
        </div>
    </section>  
<?php include 'footer.php'; ?>