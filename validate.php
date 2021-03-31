<?php

require_once 'dbconn.php';
require_once 'functions.php';

$successfulInsertion = false;

if (isset($_POST['name'])) {
    $db = getDB();
    $successfulInsertion = addGame($_POST, $db);
}

if ($successfulInsertion) {
    header('Location: index.php');
} else {
    header('Location: add-game.html');
}

?>