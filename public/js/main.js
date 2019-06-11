var articles = document.getElementById('articles');

if (articles) {
    articles.addEventListener('click', event => {
        if (event.target.className === "btn btn-danger delete-article") {
            if (confirm('Are you sure you want to delete this article?')) {
                let id = event.target.getAttribute('data-id');

                fetch(`/article/delete/${id}`, {
                    method: 'DELETE'
                })
                // vraca Promise
                .then(result => window.location.reload());
            }
        }
    })
}