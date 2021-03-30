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
 * returns a string containing html elements that display the data contained within the provided games array
 *
 * @param array $games of associative arrays containing individual board game information
 *
 * @return string consisting of html elements representing board game information
 */
function displayGames (array $games) : string {
    $html = '';
    foreach ($games as $game)
    {
        $html .= '<article>';

        if (isset($game['image-url']) && $game['name'])
            $html .= '<img tabindex="1" src="'. $game['image-url'] .'" alt="Image of the box for '. $game['name'] .'" />';

        $html .= '<div>';

        if (isset($game['year-published']) && $game['name'])
            $html .= '<h2 tabindex="1">' . $game['name'] . ' (' . $game['year-published'] . ')</h2>';

        if (isset($game['rating']))
            $html .= '<h2 tabindex="1">Rating: ' . $game['rating'] . '/10</h2>';

        if (isset($game['complexity']))
            $html .= '<h2 tabindex="1">Complexity: ' . $game['complexity'] . '/5</h2>';

        if (isset($game['player-count-min']) && $game['player-count-max'])
        {
            $html .= '<h2 tabindex="1">Player Count: ' . $game['player-count-min'];
            if ($game['player-count-min'] !== $game['player-count-max'])
                $html .= '-' . $game['player-count-max'];
            $html .= '</h2>';
        }

        if (isset($game['play-time-min']) && $game['play-time-max'])
        {
            $html .= '<h2 tabindex="1">Play Time: ' . $game['play-time-min'];
            if ($game['play-time-min'] !== $game['play-time-max'])
                $html .= '-' . $game['play-time-max'];
            $html .= ' minutes</h2>';
        }

        if (isset($game['description']))
            $html .= '<p tabindex="1">' . $game['description'] . '</p>';

        $html .= '</div>';

        $html .= '</article>';
    }
    return $html;
}

?>