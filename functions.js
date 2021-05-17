/**
 * function to fetch an object containing board game data from the boardgamegeek.com API
 * using its boardgamegeek ID
 *
 * @param {string} bggId the boardgamegeek game ID
 * @param {function} callback callback function that takes in & uses the fetched board game object
 */
const fetchGame = (bggId, callback) => {
    fetch(`https://boardgamegeek.com/xmlapi2/thing?id=${bggId}&stats=1`)
        .then(boardGameData => boardGameData.text())
        .then(xmlString => {
            let parser = new DOMParser()
            return parser.parseFromString(xmlString, 'text/xml')
        })
        .then(xml => xml2json(xml, ''))
        .then(jsonString => JSON.parse(jsonString))
        .then(gameObject => {callback(gameObject, bggId)})
}

/**
 * function to display a board game to the page using a Handlebars template from a board game object
 *
 * @param {object} gameObject object containing all the board game's information in the format of the boardgamegeek API
 * @param {string} id the boardgamegeek game ID
 */
const displayGame = (gameObject, id) => {
    fetch('boardGamesTemplate.hbs')
        .then(templateData => templateData.text())
        .then(templateString => Handlebars.compile(templateString))
        .then(template => {
            gameObject.items.item.statistics.ratings.average['@value'] = parseFloat(gameObject.items.item.statistics.ratings.average['@value']).toFixed(1)
            gameObject.items.item.statistics.ratings.averageweight['@value'] = parseFloat(gameObject.items.item.statistics.ratings.averageweight['@value']).toFixed(2)
            gameObject.items.item.description = gameObject.items.item.description.replaceAll('&amp;', '&')
            document.getElementById(id).innerHTML = template(gameObject)
        })
}

/**
 * function to fetch an object containing board game search data from the BoardGameGeek API
 * using its BoardGameGeek ID
 *
 * @param {string} query the search query
 * @param {function} callback callback function that takes in & uses the fetched board game search object
 */
const searchGames = (query, callback) => {
    query = query.toLowerCase().replaceAll(' ', '+')
    fetch(`https://boardgamegeek.com/xmlapi2/search?query=${query}&type=boardgame`)
        .then(data => data.text())
        .then(xmlString => {
            let parser = new DOMParser()
            return parser.parseFromString(xmlString, 'text/xml')
        })
        .then(xml => xml2json(xml, ''))
        .then(jsonString => JSON.parse(jsonString))
        .then(gameList => {
            if (gameList.items.item) {
                gameList.items.item.forEach(game => {
                    fetch(`is-game-added.php?bgg-id=${game['@id']}`)
                        .then(data => data.text())
                        .then(result => {
                            if (result == 'true') {
                                game.added = true;
                            }
                        })
                })
            }
            return gameList;
        })
        .then(callback)
}

/**
 * function to display a list of searched board games to the page using a Handlebars template from a parsed BoardGameGeek API search query
 *
 * @param {object} gameList object containing the board game search information in the format of a BoardGameGeek API search query
 */
const displaySearchGames = (gameList) => {
    fetch('searchGameListTemplate.hbs')
        .then(templateData => templateData.text())
        .then(templateString => Handlebars.compile(templateString))
        .then(template => {
            if (gameList.items.item) {
                document.querySelector('table').innerHTML = template(gameList)
            } else {
                document.querySelector('table').innerHTML = 'No Results'
            }
        })
        .then(() => {
            document.querySelectorAll('.add-game-button').forEach(addGameButton => {
                addGameButton.addEventListener('click', addGameButtonAction)
            })
        })
}

/**
 * function to add a board game to the database after clicking a button & change the state of said button
 *
 * @param {object} e the (button click) event triggering the function
 */
const addGameButtonAction = (e) => {
    let formData = new FormData()
    formData.append('bgg-id', e.target.dataset.bggId)
    fetch('add-game-validate.php', {
        method: 'post',
        body: formData
    })
        .then(data => data.text())
        .then(result => {
            if (result == 'success') {
                e.target.textContent = 'Added'
                e.target.classList.add('disabled')
            }
        })
}