document.getElementById('searchButton').addEventListener('click', e => {
    e.preventDefault()
    searchGames(document.getElementById('searchName').value)
})