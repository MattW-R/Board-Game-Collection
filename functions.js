const fetchGame = (bggId, callback) => {
    fetch(`https://boardgamegeek.com/xmlapi2/thing?id=${bggId}&stats=1`)
        .then(boardGameData => boardGameData.text())
        .then(xmlString => {
            let parser = new DOMParser()
            return parser.parseFromString(xmlString, 'text/xml')
        })
        .then(xml => xml2json(xml, ''))
        .then (jsonString => JSON.parse(jsonString))
        .then (callback)
}

const displayGame = (gameObject) => {
    fetch('boardGamesTemplate.hbs')
        .then(templateData => templateData.text())
        .then(templateString => Handlebars.compile(templateString))
        .then(template => {
            gameObject.items.item.statistics.ratings.average['@value'] = parseFloat(gameObject.items.item.statistics.ratings.average['@value']).toFixed(1)
            gameObject.items.item.statistics.ratings.averageweight['@value'] = parseFloat(gameObject.items.item.statistics.ratings.averageweight['@value']).toFixed(2)
            gameObject.items.item.description = gameObject.items.item.description.replaceAll('&amp;', '&')
            // document.getElementById(bggId).innerHTML = template(object)

            // DEBUG
            console.log(gameObject)
            document.querySelectorAll('article')[0].innerHTML = template(gameObject)
        })
}

// DEBUG
fetchGame('259996', displayGame)