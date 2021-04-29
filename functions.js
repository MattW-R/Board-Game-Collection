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
        .then(callback)
}

const displaySearchGames = (gameList) => {
    fetch('searchGameListTemplate.hbs')
        .then(templateData => templateData.text())
        .then(templateString => Handlebars.compile(templateString))
        .then(template => {
            document.querySelector('table').innerHTML = template(gameList)
        })
}