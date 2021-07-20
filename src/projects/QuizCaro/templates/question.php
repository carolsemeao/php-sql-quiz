<?php
    // config include
    include '../config.php';
    

    // Get the ID of the question from the post object
    // Get the question data for the given ID
    if (isset($_POST['nextQuestionID'])) {
        $questionID = $_POST['nextQuestionID'];
        //echo "Question ID is " . $questionID . "<br>";
        $pageData = questionDataFromDB($_SESSION['quizID'], $questionID);
        //$pageData = $quizData['questions'][$questionID];
    }

    // Session object: Update number of achieved points
    // var_dump($_POST);
    if (isset($_POST['radio'])){
        $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
    }
?>
<?php include 'header.php'; ?>
    <div class="box">
        <div class="question-box1">
            <div class="question-box2">
                <div class="question">
                    <?php
                        echo '<h3 class = "questionID">' . $pageData['Text'] . '</h3>'; 
                    ?>
                </div>

                <div class = "answers-box">
                    <form class = "answer-form" action="<?php echo $pageData['nextAction']; ?>" method="post">
                        <div class="choices">
                            <input type="radio" id="answer0" name="radio" 
                                value="<?php echo $pageData['Answers'][0]['IsRightAnswer']; ?>">
                            <label for="answer0"><?php echo '<div class = "answer">' . $pageData['Answers'][0]['Text'] . '</div>'; ?></label><br>
                        </div>
                        <div class="choices">
                            <input type="radio" id="answer1" name="radio" 
                                value="<?php echo $pageData['Answers'][1]['IsRightAnswer']; ?>">
                            <label for="answer1"><?php echo '<div class = "answer">' . $pageData['Answers'][1]['Text'] . '</div>'; ?></label><br>
                        </div>
                        <div class="choices">
                            <input type="radio" id="answer2" name="radio" 
                                value="<?php echo $pageData['Answers'][2]['IsRightAnswer']; ?>">
                            <label for="answer2"><?php echo '<div class = "answer">' . $pageData['Answers'][2]['Text'] . '</div>'; ?></label><br>
                        </div>
                        <div class="choices">
                            <input type="radio" id="answer3" name="radio" 
                                value="<?php echo $pageData['Answers'][3]['IsRightAnswer']; ?>">
                            <label for="answer3"><?php echo '<div class = "answer">' . $pageData['Answers'][3]['Text'] . '</div>'; ?></label><br><br>
                        </div>

                        <form action="<?php echo $pageData['nextAction']; ?>" method="post">
                            <input type="hidden" name="nextQuestionID" value="<?php echo $pageData['nextQuestionID']; ?>">
                            <button class ="nxt-btn"><h3>NEXT</h3></button>
                        </form>
                    </form>
                </div>  
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>