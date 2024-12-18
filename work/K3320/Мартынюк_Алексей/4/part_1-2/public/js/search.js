// search bar

function updateState() {
    const categorySelect = document.querySelector('#search-wrapper select');
    const searchInput = document.querySelector('#search-wrapper input');

    let href = '/search.php?category=' + categorySelect.value;
    if (searchInput.value !== '') {
        href += '&search=' + searchInput.value;
    }

    document.location.href = href;
}

document.querySelector('#searchbar').addEventListener('submit', function(e) {
    e.preventDefault();
    updateState();
});

document.querySelector('#search-wrapper select').addEventListener('change', updateState);