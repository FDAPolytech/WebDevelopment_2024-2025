const urls = [
    'https://my.itmo.ru/',
    'https://cap.ru/',
    'https://www.wikipedia.org'
];
const interval = 6000;
let currentIndex = 0;

function changePage() {
    const frame = document.getElementById('webFrame');
    frame.src = urls[currentIndex];
    currentIndex = (currentIndex + 1) % urls.length;
}

setInterval(changePage, interval);
changePage();