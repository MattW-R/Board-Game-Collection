<?php

/**
 * returns an indexed array of associative arrays containing board game information from a database containing said information
 *
 * @param PDO $db with link to database containing board game information
 *
 * @return array of associative arrays containing individual board game information
 */
function getGames (PDO $db) : array
{
    $query = $db->prepare("SELECT `name`, `description`, `year-published`, `player-count-min`,
       `player-count-max`, `play-time-min`, `play-time-max`, `rating`, `complexity`, `image-url` FROM `games`");
    $query->execute();
    return $query->fetchAll();
}

?>