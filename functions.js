const fetchAndDisplayGame = (bggId) => {
    fetch('https://boardgamegeek.com/xmlapi2/thing?id=' + bggId)
        .then(boardGameData => boardGameData.text())
        .then(xmlString => {
            let parser = new DOMParser()
            return parser.parseFromString(xmlString, 'text/xml')
        })
        .then(xml => xml2json(xml, ''))
        .then (jsonString => JSON.parse(jsonString))
        .then (json => console.log(json))
}