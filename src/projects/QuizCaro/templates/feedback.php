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

    //$pageData = feedbackDataFromDB();

    if(isset($_POST['submit'])){
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $connection = new PDO("mysql:host=mysql; dbname=demo;", $username,$password); 
                   
        $insertQuery = $connection->prepare("INSERT INTO Feedback(Name,Email,Text) VALUES(:Name,:Email,:Text) ");
        $insertQuery -> bindParam("Name",$_POST['Name']);
        $insertQuery -> bindParam("Email",$_POST['Email']);
        $insertQuery -> bindParam("Text",$_POST['Text']);

        if($insertQuery->execute()){
            //echo "Thank You For Your Feedback!";
            //exit();
            header('Location: thanks.php');
        }
    }
?>
<?php include 'header.php'; ?>
    <section class="form-sct">
        <div class="container">
            <h1 class="fback-title">Feedback</h1>
            <form action="" method="post">

                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="Name" placeholder="Your Name" required>

                <label for="inputMail">Email</label>
                <input type="mail" id="inputMail" name="Email" placeholder="Your Email" required>

                <label for="inputMessage">Message</label>
                <textarea id="inputMessage" name="Text" placeholder="Your Message.." required></textarea>
                
                <input type="submit" name="submit" value="Submit"/>

            </form>
        </div>
    </section>
<?php include 'footer.php'; ?>