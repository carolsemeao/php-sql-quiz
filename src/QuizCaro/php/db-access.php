<?php

if(strpos($_SERVER['HTTP_HOST'], 'localhost:') !== false) {
    define('DB_NAME', getenv('DB_NAME'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_HOST', getenv('DB_HOST'));
}
else{
    define('DB_NAME', 'ipiluwig_cs');
    define('DB_USER', 'ipiluwig_02');
    define('DB_PASSWORD', 'iLoveCoding!');
    define('DB_HOST', 'ipiluwig.mysql.db.internal');
}

    // switch tracing on/off
    define('TRACE_DB_ACCESS', false);
/*
    Creates or reuses a single PDO connection object
*/

function DBConnection(){
    //Reuse single connection object if already available
    //if (isset($_dbconnnection)) return $_dbconnnection;

    try {
        // PHP Data Objects Extension (PDO)
        // https://www.php.net/manual/de/book.pdo.php
        $connection = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', 
                DB_USER, 
                DB_PASSWORD
        );
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo '<p>connection failed' . $e -> getMessge() . '</p>';
        echo 'HTTP_HOST = ' . $_SERVER['HTTP_HOST'] . '<br>';

        echo 'DB_NAME = ' . DB_NAME . '<br>';
        echo 'DB_USER = ' . DB_USER . '<br>';
        echo 'DB_PASSWORD = ' . DB_PASSWORD . '<br>';
        echo 'DB_HOST = ' . DB_HOST . '<br>';
    }
    

    return $connection;
}


// ================ introduction data =======================

function introductionFromDataBase ($quizID){
    //if(TRACE_DB_ACCESS) print "<h1> Harry Pooter </h1>";

    // Prepare, bind and execute  SELECT statement
    $query = DBConnection() -> prepare("SELECT * FROM Introduction WHERE quizID = ?");
    $query -> bindValue(1, $quizID); // => "SELECT * FROM introduction WHERE quizID = 1"
    $query-> execute();

    // Fetch the introduction's record (whole row) as assoc array
    $introduction = $query -> fetch(PDO::FETCH_ASSOC);
 
    return $introduction;
}




// ================ questions data =======================

function questionDataFromDB($quizID, $questionID){
    //if(TRACE_DB_ACCESS) print "<h1> Question Data </h1>";

    //Prepare, bind, execute SELECT statement
    $query =  DBConnection() -> prepare("SELECT * FROM Question WHERE quizID = ? AND ID = ?");
    $query -> bindValue(1, $quizID);
    $query -> bindValue(2, $questionID);
    $query -> execute();

    //Fetch the record (whole row) as assoc array
    $data = $query -> fetch(PDO::FETCH_ASSOC);

    // Associate the answers to the other question data
    $data['Answers'] = answerDataFromDB($questionID);

    return $data;
}



// ================ answers data =======================

function answerDataFromDB($questionID){
    //print "<h1>ANSWER DATA</h1>";

        //Prepare, bind, execute SELECT statement
        $query =  DBConnection() -> prepare("SELECT Text, IsRightAnswer FROM Answers WHERE questionID = ?");
        $query -> bindValue(1, $questionID);
        $query -> execute();

        // Fetch array of all answers, each answer as assoc array
        $answers = $query -> fetchAll(PDO::FETCH_ASSOC);

        return $answers;
}



// ================ count questions for report page =======================

function questionNumbers($quizID) {
    //print "<h1>REPORT DATA</h1>";
    //var_dump($quizID);

    //Prepare, bind, execute SELECT statement
    $query =  DBConnection() -> prepare("SELECT ID FROM Question WHERE quizID = ?");
    $query -> bindValue(1, $quizID);
    $query -> execute();

    $questionIds = $query -> fetchAll(PDO::FETCH_ASSOC);
    //print_r($questionIds);

    return $questionIds;

}



// ================ report page data =======================
function reportDataFromDB($quizID){
    //print '<h1> I need a break </h1>';
    
    //Prepare, bind, execute SELECT statement
    $query =  DBConnection() -> prepare("SELECT * FROM report WHERE quizID = ?");
    $query -> bindValue(1, $quizID);
    $query -> execute();

    $report = $query -> fetch(PDO::FETCH_ASSOC);
    //print_r($report);

    return $report;
}

?>