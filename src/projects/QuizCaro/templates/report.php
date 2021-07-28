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

 
    // Get quiz data
    $pageData = reportDataFromDB($quizID);
    $questionNum = questionNumbers($quizID);

    
    // Session object: Update number of achieved points
    // var_dump($_POST);
    if (isset($_POST['radio'])){
        $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
    }
    //print_r($_SESSION);

    $percentage = ($_SESSION['achievedPoints'] / count($questionNum) * 100);
    
?>
<?php include 'header.php'; ?>
    <div class="box">
        <div class="question-box1">
            <div class="question-box2 report-box">
                <div class="title"><?php echo $pageData['title'];?></div>
                <div class="desc-feed">
                    <div class="description"><?php echo $pageData['text'];?></div>
                    <div class="feedback-sct">
                        <?php
                            if($percentage >= 80){
                                echo '" ' . $pageData['feedback_80'] . ' "';
                            }
                            elseif($percentage >= 60){
                                echo '" ' . $pageData['feedback_60'] . ' "';
                            }
                            elseif($percentage <= 40){
                                echo '" ' . $pageData['feedback_40'] . ' "';
                            }
                        ;?>
                    </div>

                    <div class="answered"><?php echo 'You have answered ' . round($percentage) . '%' . ' of the questions correctly.';?></div>
                </div>
                <form action="/projects/QuizCaro/templates/introduction.php?qid=1">
                    <button class ="nxt-btn retry-btn">Retry <i class="fas fa-undo"></i></button>
                </form>
                <form action="/projects/QuizCaro/templates/feedback.php?qid=1">
                    <button class ="nxt-btn retry-btn">Feedback <i class="far fa-envelope"></i></button>
                </form>
            </div>
        </div>
    </div>
 <?php include 'footer.php'; ?>