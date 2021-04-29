<?php

require_once 'dbconn.php';
require_once 'functions.php';

$successfulInsertion = false;

if (isset($_POST['bgg-id'])) {
    $db = getDB();
    $successfulInsertion = addGame($_POST, $db);
}

if ($successfulInsertion) {
    echo 'success';
} else {
    echo 'failure';
}

?>