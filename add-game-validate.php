<?php

require_once 'dbconn.php';
require_once 'functions.php';

$successfulInsertion = false;
if (isset($_POST['bgg-id'])) {
    $db = getDB();
    $isValid = validateInputGameArray($_POST);
    if ($isValid) {
        $isAdded = isGameAdded($_POST, $db);
        if (!$isAdded) {
            $successfulInsertion = addGame($_POST, $db);
        }
    }
}

if ($successfulInsertion) {
    echo 'success';
} else {
    echo 'failure';
}
