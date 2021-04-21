const fetchAndDisplayGame = (bggId) => {
    fetch('boardGamesTemplate.hbs')
        .then(templateData => templateData.text())
        .then(templateString => Handlebars.compile(templateString))
        .then(template => {
            fetch(`https://boardgamegeek.com/xmlapi2/thing?id=${bggId}&stats=1`)
                .then(boardGameData => boardGameData.text())
                .then(xmlString => {
                    let parser = new DOMParser()
                    return parser.parseFromString(xmlString, 'text/xml')
                })
                .then(xml => xml2json(xml, ''))
                .then (jsonString => JSON.parse(jsonString))
                .then (object => {
                    object.items.item.description = object.items.item.description.replaceAll('&amp;', '&')
                    // document.getElementById(bggId).innerHTML = template(object)
                    // DEBUG
                    console.log(object)
                    document.querySelectorAll('article')[0].innerHTML = template(object)
                })
        })


}

// DEBUG
fetchAndDisplayGame('259996')