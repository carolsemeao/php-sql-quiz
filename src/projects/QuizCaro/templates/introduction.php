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
    
    
    $pageData = introductionFromDataBase($quizID);
    
    
    $_SESSION['achievedPoints'] = 0;
    ?>
<?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="intro">
            <?php 
                // write hyperlink with GET parameters
                echo '<h1>Welcome To The Ultimate Harry Potter Quiz</h1>';
            ?>
            <form action="<?php echo $pageData['nextAction']; ?>" method="post">
                <input type="hidden" name="nextQuestionID" value="<?php echo $pageData['nextQuestionID']; ?>">
                <button class ="btn"><h3>Test your knowledge </h3><i class="fas fa-feather-alt fa-2x"></i></button>
            </form>
        </div>
    </div>
<?php include 'footer.php'; ?>