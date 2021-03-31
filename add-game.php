<html lang="en-GB">
    <head>
        <title>Add Game to Collection</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Yatra+One&display=swap" rel="stylesheet" />
        <link href="normalize.css" type="text/css" rel="stylesheet" />
        <link href="styles.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <nav>
            <h1 tabindex="1">Add Game to Collection</h1>
            <button href="index.php" tabindex="1">Back</button>
        </nav>
        <form method="post" action="add-game.php">
            <label for="bgg-id">Board Game Geek ID: </label>
            <input name="bgg-id" id="bgg-id" type="number" required />
            <label for="name">Name: </label>
            <input name="name" id="name" type="text" required />
            <label for="description">Description: </label>
            <textarea name="description" id="description" rows="10"></textarea>
            <label for="year-published">Year Published: </label>
            <input name="year-published" id="year-published" type="number" max="3000" required />
            <label for="player-count-min">Player Count (Min): </label>
            <input name="player-count-min" id="player-count-min" type="number" min="1" required />
            <label for="player-count-max">Player Count (Max): </label>
            <input name="player-count-max" id="player-count-max" type="number" min="1" required />
            <label for="play-time-min">Play Time (Min): </label>
            <input name="play-time-min" id="play-time-min" type="number" min="1" required />
            <label for="play-time-max">Play Time (Max): </label>
            <input name="play-time-max" id="play-time-max" type="number" min="1" required />
            <label for="rating">Rating (/10): </label>
            <input name="rating" id="rating" type="number" min="0" max="10" required />
            <label for="complexity">Complexity Rating (/5): </label>
            <input name="complexity" id="complexity" type="number" min="0" max="5" required />
            <label for="image-url">Image URL: </label>
            <input name="image-url" id="image-url" type="text" maxlength="2048" required />
            <input value="Add" type="submit" class="button" />
        </form>
    </body>
</html>