<?php
//start session and initialize achieved number of points
session_start();

// preset paths to standard include folders (concat them with PATH_SEPARATOR)
$incPaths = $_SERVER['DOCUMENT_ROOT'] . '/php'; // Site root includes
$incPaths .= PATH_SEPARATOR;
$incPaths .= $_SERVER['DOCUMENT_ROOT'] . '/QuizCaro/php';
set_include_path($incPaths);

// includes required for all page templates
include 'db-access.php';
//include 'auth.php';