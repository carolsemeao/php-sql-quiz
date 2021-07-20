<?php
    // Preset path to include folder 
    //echo $_SERVER['DOCUMENT_ROOT'];
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/QuizCaro/php');
?>
<?php // header include 
include 'header.php'; ?>

<div class="container-fluid">
    <div class="intro">
        <?php 
            // write hyperlink with GET parameters
            echo '<h1>Welcome To The Ultimate Harry Potter Quiz</h1>';
        ?>
        <form action="/QuizCaro/templates/introduction.php?qid=1">
            <button class ="btn">Test your knowledge<ion-icon name="paper-plane-outline" class = "paper-plane"></ion-icon></button>
        </form>
    </div>
</div>
<?php
    // footer include
    include 'footer.php';
?>