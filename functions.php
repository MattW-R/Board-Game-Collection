<?php

/**
 * returns an indexed array of associative arrays containing board game information from a database containing said information
 *
 * @param PDO $db with link to database containing board game information
 *
 * @return array of associative arrays containing individual board game information
 */
function getGames(PDO $db): array
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
function displayGames(array $games): string {
    $html = '';
    foreach ($games as $game)
    {
        $html .= '<article>';

        if (isset($game['image-url']) && $game['name'])
            $html .= '<img tabindex="2" src="'. $game['image-url'] .'" alt="Image of the box for '. $game['name'] .'" />';

        $html .= '<div>';

        if (isset($game['year-published']) && $game['name'])
            $html .= '<h2 tabindex="2">' . $game['name'] . ' (' . $game['year-published'] . ')</h2>';

        if (isset($game['rating']))
            $html .= '<h2 tabindex="2">Rating: ' . $game['rating'] . '/10</h2>';

        if (isset($game['complexity']))
            $html .= '<h2 tabindex="2">Complexity: ' . $game['complexity'] . '/5</h2>';

        if (isset($game['player-count-min']) && $game['player-count-max'])
        {
            $html .= '<h2 tabindex="2">Player Count: ' . $game['player-count-min'];
            if ($game['player-count-min'] !== $game['player-count-max'])
                $html .= '-' . $game['player-count-max'];
            $html .= '</h2>';
        }

        if (isset($game['play-time-min']) && $game['play-time-max'])
        {
            $html .= '<h2 tabindex="2">Play Time: ' . $game['play-time-min'];
            if ($game['play-time-min'] !== $game['play-time-max'])
                $html .= '-' . $game['play-time-max'];
            $html .= ' minutes</h2>';
        }

        if (isset($game['description']))
            $html .= '<p tabindex="2">' . $game['description'] . '</p>';

        $html .= '</div>';

        $html .= '</article>';
    }
    return $html;
}

/**
 * validates whether an input associative array has the correct format of key-value pairs to be used to insert data into the database
 *
 * @param array $game array to be validated
 *
 * @return bool indicating whether the given array is valid
 */
function validateInputGameArray(array $game): bool {
    if (array_key_exists('name', $game) && is_string($game['name'])
        && array_key_exists('bgg-id', $game) && is_numeric($game['bgg-id'])
        && (!array_key_exists('description', $game) || (array_key_exists('description', $game) && is_string($game['description'] && strlen($game['description'] <= 65535))))
        && array_key_exists('year-published', $game) && is_numeric($game['year-published'])
        && array_key_exists('player-count-min', $game) && is_numeric($game['player-count-min'])
        && array_key_exists('player-count-max', $game) && is_numeric($game['player-count-max'])
        && array_key_exists('play-time-min', $game) && is_numeric($game['play-time-min'])
        && array_key_exists('play-time-max', $game) && is_numeric($game['play-time-max'])
        && array_key_exists('rating', $game) && is_numeric($game['rating'])
        && array_key_exists('complexity', $game) && is_numeric($game['complexity'])
        && array_key_exists('image-url', $game) && is_string($game['image-url'])
    ) {
        if (strlen($game['name']) > 0 && strlen($game['name']) <= 255
            && $game['bgg-id'] > 0
            && $game['year-published'] > -9999 && $game['year-published'] < 9999
            && $game['player-count-min'] > 0 && $game['player-count-min'] < 9999
            && $game['player-count-max'] > 0 && $game['player-count-max'] < $game['player-count-min']
            && $game['play-time-min'] > 0 && $game['play-time-min'] < 9999
            && $game['play-time-max'] > 0 && $game['play-time-max'] < $game['play-time-min']
            && $game['rating'] > 0 && $game['rating'] <= 10
            && $game['complexity'] > 0 && $game['complexity'] <= 5
            && filter_var($game['image-url'], FILTER_VALIDATE_URL) && strlen($game['image-url']) <= 255
        ) {
            return true;
        }
    }
    return false;
}

/**
 * inserts a new board game into the database using an associative array with the correct keys after validating & sanitising the values
 *
 * @param array $game containing keys containing properties associated with the board game being input
 * @param PDO $db linked to the board game database to add the new board game into
 *
 * @return bool indicating whether the validation & database insertion was a success
 */
function addGame(array $game, PDO $db): bool {
    if (validateInputGameArray($game)) {
        $query = $db->prepare('INSERT INTO `games` (`name`, `bgg-id`, `description`, `year-published`,
                         `player-count-min`, `player-count-max`, `play-time-min`, `play-time-max`, `rating`, 
                         `complexity`, `image-url`) VALUES (:name, :bgg-id, :description, :year-published, 
                        :player-count-min, :player-count-max, :play-time-min, :play-time-max, :rating, :complexity,
                        :image-url)');
        $query->bindParam('name', $game['name']);
        $query->bindParam('bgg-id', $game['bgg-id']);
        $query->bindParam('description', $game['description']);
        $query->bindParam('year-published', $game['year-published']);
        $query->bindParam('player-count-min', $game['player-count-min']);
        $query->bindParam('player-count-max', $game['player-count-max']);
        $query->bindParam('play-time-min', $game['play-time-min']);
        $query->bindParam('play-time-max', $game['`play-time-max']);
        $query->bindParam('rating', $game['rating']);
        $query->bindParam('complexity', $game['rating']);
        $query->bindParam('image-url', $game['image-url']);
        return $query->execute();
    }
    else return false;
}

?>