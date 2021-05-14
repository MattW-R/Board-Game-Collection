<?php

require_once 'dbconn.php';
require_once 'functions.php';

$isGameAdded = false;
if (isset($_GET['bgg-id'])) {
    $db = getDB();
    $isValid = validateInputGameArray($_GET);
    if ($isValid) {
        $isGameAdded = isGameAdded($_GET, $db);
    }
}

if ($isGameAdded) {
    echo 'true';
} else {
    echo 'false';
}
