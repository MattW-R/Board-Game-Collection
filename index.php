<?php

require_once 'dbconn.php';
require_once 'functions.php';

$db = getDB();

$games = getGames($db);

?>

<html lang="en-GB">
    <head>
        <title>Matt's Board Game Collection</title>
        <link href="normalize.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <nav>
            <h1>Matt's Board Game Collection</h1>
            <button>Add Game</button>
        </nav>
        <main>
            <?= displayGames($games); ?>
        </main>
    </body>
</html>