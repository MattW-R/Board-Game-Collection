<?php

require_once 'dbconn.php';
require_once 'functions.php';

$db = getDB();

$games = getGames($db);

$gameArticles = displayGames($games);

?>

<html lang="en-GB">
    <head>
        <title>Matt's Board Game Collection</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Yatra+One&display=swap" rel="stylesheet" />
        <link href="normalize.css" type="text/css" rel="stylesheet" />
        <link href="styles.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <nav>
            <h1 tabindex="1">Matt's Board Game Collection</h1>
            <a href="add-game.php" tabindex="1" class="button">Add Game</a>
        </nav>
        <main>
            <?= $gameArticles ?>
        </main>
    </body>
</html>