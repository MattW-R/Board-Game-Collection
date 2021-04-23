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
    $query = $db->prepare("SELECT `bgg-id` FROM `games`");
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
        if (isset($game['bgg-id']))
            $html .= "<script>fetchGame('" . $game['bgg-id'] . "', displayGame)</script>";
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
        && (!array_key_exists('description', $game) || (array_key_exists('description', $game) && is_string($game['description']) && strlen($game['description']) <= 65535))
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
            && $game['player-count-max'] > 0 && $game['player-count-max'] >= $game['player-count-min']
            && $game['play-time-min'] > 0 && $game['play-time-min'] < 9999
            && $game['play-time-max'] > 0 && $game['play-time-max'] >= $game['play-time-min']
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
        if (filter_var_array($game, FILTER_SANITIZE_STRING)) {
            $query = $db->prepare('INSERT INTO `games` (`name`, `bgg-id`, `description`, `year-published`,
                         `player-count-min`, `player-count-max`, `play-time-min`, `play-time-max`, `rating`, 
                         `complexity`, `image-url`) VALUES (:Game, :BggId , :Description , :YearPublished , 
                        :PlayerCountMin , :PlayerCountMax , :PlayTimeMin , :PlayTimeMax , :Rating , :Complexity ,
                        :ImageUrl );');
            $query->bindParam(':Game', $game['name']);
            $query->bindParam(':BggId', $game['bgg-id']);
            $query->bindParam(':Description', $game['description']);
            $query->bindParam(':YearPublished', $game['year-published']);
            $query->bindParam(':PlayerCountMin', $game['player-count-min']);
            $query->bindParam(':PlayerCountMax', $game['player-count-max']);
            $query->bindParam(':PlayTimeMin', $game['play-time-min']);
            $query->bindParam(':PlayTimeMax', $game['play-time-max']);
            $query->bindParam(':Rating', $game['rating']);
            $query->bindParam(':Complexity', $game['complexity']);
            $query->bindParam(':ImageUrl', $game['image-url']);
            return $query->execute();
        }
    }
    else return false;
}

?>