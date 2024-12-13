const urlInput = document.getElementById('page-url');
const intervalInput = document.getElementById('interval');
const addUrlButton = document.getElementById("addUrl");
const startShowButton = document.getElementById('startShow');
const pagesDiv = document.getElementById('pages');
let pages = [];
let currentUrlIndex = 0;
let intervalId;


addUrlButton.addEventListener('click', () => {
    const url = urlInput.value.trim();
    if (url) {
        pages.push(url);
        urlInput.value = '';
        updatePagesList();
    }
});

function updatePagesList() {
    pagesDiv.innerHTML = ''; // Очищаем список
    pages.forEach((url, index) => {
        const p = document.createElement('p');
        p.textContent = `${index + 1}. ${url}`;
        pagesDiv.appendChild(p);
    });
}


startShowButton.addEventListener('click', () => {
    if (pages.length === 0) {
        alert('Добавьте ссылки!');
        return;
    }
    const interval = parseInt(intervalInput.value) * 1000;
    clearInterval(intervalId);
    currentUrlIndex = 0;
    showNextPage();

    intervalId = setInterval(showNextPage, interval);
});


function showNextPage() {
    iframe.src = pages[currentUrlIndex];
    currentUrlIndex = (currentUrlIndex + 1) % pages.length;
}
