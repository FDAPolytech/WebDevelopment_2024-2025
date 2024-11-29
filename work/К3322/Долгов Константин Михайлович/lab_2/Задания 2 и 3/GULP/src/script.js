const urlForm = document.getElementById('urlForm');
const intervalForm = document.getElementById('intervalForm');
const urlList = document.getElementById('urlList');
const viewer = document.getElementById('viewer');

let urls = JSON.parse(localStorage.getItem('urls')) || []; 
let interval = parseInt(localStorage.getItem('interval'), 10) || 5;
let currentIndex = 0;
let timer;

function saveUrls() {
    localStorage.setItem('urls', JSON.stringify(urls)); 
    renderUrlList();
}

function saveInterval() {
    localStorage.setItem('interval', interval.toString());
}

function renderUrlList() {
    urlList.innerHTML = '';
    urls.forEach((url, index) => {
        const listItem = document.createElement('li');
        listItem.textContent = url;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Удалить';
        deleteButton.style.marginLeft = '10px';
        deleteButton.onclick = () => {
            urls.splice(index, 1);
            saveUrls();
        };

        listItem.appendChild(deleteButton);
        urlList.appendChild(listItem);
    });
}

function updateIframe() {
    if (urls.length > 0) {
        viewer.src = urls[currentIndex];
        currentIndex = (currentIndex + 1) % urls.length;
    }
}

function startRotation() {
    clearInterval(timer);
    if (urls.length > 0) {
        timer = setInterval(updateIframe, interval * 1000);
    }
}

urlForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const url = document.getElementById('url').value;
    if (url && !urls.includes(url)) {
        urls.push(url);
        saveUrls();
    }
    document.getElementById('url').value = '';
});

intervalForm.addEventListener('submit', (e) => {
    e.preventDefault();
    interval = parseInt(document.getElementById('interval').value, 10);
    saveInterval();
    startRotation();
});

function init() {
    renderUrlList();
    startRotation();
}

init();
