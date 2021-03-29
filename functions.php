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

/**
 * echoes html articles to the front end containing html elements that display the data contained within the provided games array
 *
 * @param array $games of associative arrays containing individual board game information
 */
function displayGames (array $games) {
    foreach ($games as $game)
    {
        echo '<article>';

        echo '<img src="'. $game['image-url'] .'" alt="Image of the box for '. $game['name'] .'" />';

        echo '<h2>' . $game['name'] . ' (' . $game['year-published'] . ')</h2>';

        echo '<h2>Rating: ' . $game['rating'] . '/10</h2>';

        echo '<h2>Complexity: ' . $game['complexity'] . '/5</h2>';

        echo '<h2>Player Count: ' . $game['player-count-min'];
        if ($game['player-count-min'] !== $game['player-count-max'])
            echo '-' . $game['player-count-max'];
        echo '</h2>';

        echo '<h2>Play Time: ' . $game['play-time-min'];
        if ($game['play-time-min'] !== $game['play-time-max'])
            echo '-' . $game['play-time-max'];
        echo ' minutes</h2>';

        echo '<p>' . $game['description'] . '</p>';

        echo '</article>';
    }
}

?>