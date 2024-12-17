const urls = [
    'https://ya.ru/',
    'https://dribbble.com/',
    'https://github.com/',
    'https://www.wikipedia.org/'
]

let currentIndex = 0;
const intervalTime = 5000; // в мс

function showNextPage() {
    const iframe = document.getElementById('webViewer');

    iframe.src = urls[currentIndex];

    currentIndex = (currentIndex + 1) % urls.length;
}

showNextPage();

setInterval(showNextPage, intervalTime);