document.querySelectorAll('article').forEach(article => {
    fetchGame(article.id, displayGame)
})