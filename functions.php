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
 * returns a string containing html elements with id attributes equal to their boardgamegeek IDs
 *
 * @param array $games of associative arrays containing boardgamegeek IDs
 *
 * @return string consisting of html article elements containing boardgamegeek IDs as id attributes
 */
function displayGames(array $games): string {
    $html = '';
    foreach ($games as $game)
    {
        if (isset($game['bgg-id']))
            $html .= "<article id=\"" . $game['bgg-id'] . "\"></article>";
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
    if (array_key_exists('bgg-id', $game) && is_numeric($game['bgg-id'])) {
        return ($game['bgg-id'] > 0 && filter_var($game['bgg-id'], FILTER_VALIDATE_INT));
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
            $query = $db->prepare('INSERT INTO `games` (`bgg-id`) VALUES (:BggId);');
            $query->bindParam(':BggId', $game['bgg-id']);
            return $query->execute();
        }
    }
    else return false;
}

?>