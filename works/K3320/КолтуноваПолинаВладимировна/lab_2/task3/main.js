// инициализация переменных
const urlInput = document.getElementById('urlInput');
const addButton = document.getElementById('addButton');
const clearButton = document.getElementById('clearButton');
const intervalInput = document.getElementById('intervalInput');
const startButton = document.getElementById('startButton');
const stopButton = document.getElementById('stopButton');
const urlsList = document.getElementById('urls');
const iframeViewer = document.getElementById('iframeViewer');
const viewer = document.getElementById('viewer');

let urls = []; // для хранения ссылок, которые вносит пользователь
let currentIndex = 0; // индекс текущего сайта, который отображается
let intervalId = null; //идентификатор интервала, для остановки просмотра сайтов

// добавление сайта в список
addButton.addEventListener('click', () => {
    const url = urlInput.value.trim();
    if (url && !urls.includes(url)) {
        urls.push(url);
        const listItem = document.createElement('li');
        listItem.textContent = url;
        urlsList.appendChild(listItem);
        urlInput.value = ''; // очищает поле ввода для удобного ввода следующего сайта
    }
});

//запуск просмотра сайтов
startButton.addEventListener('click', () => {
    if (urls.length === 0) {
        alert('Сначала добавьте хотя бы один сайт!');
        return;
    }

    const interval = parseInt(intervalInput.value) * 1000; // преобразование в миллисекунды
    currentIndex = 0;
    viewer.style.display = 'block';
    iframeViewer.src = urls[currentIndex]; // загрузка сайта с индексом currentIndex в элемент <iframe>

    // очищает предыдущий интервал, если он существует
    if (intervalId) {
        clearInterval(intervalId);
    }

    intervalId = setInterval(() => { // ф-ция, циклически меняющая содержимое элемента <iframe>,
                                           // загружая новые сайты с интервалом в миллисекундах
        currentIndex = (currentIndex + 1) % urls.length;
        iframeViewer.src = urls[currentIndex];
    }, interval);
});

//остановка просмотра сайтов
stopButton.addEventListener('click', () => {
    // останавливает интервал, если он существует
    if (intervalId) {
        clearInterval(intervalId);
        intervalId = null; // сбрасывает ID интервала
        viewer.style.display = 'none'; // скрывает просмотр
    }
});

//очистка списка сайтов
clearButton.addEventListener('click', () => {
    urls = []; // очищает массив URL
    urlsList.innerHTML = ''; // очищает отображаемый список
    stopButton.click(); // останавливает просмотр, если он идет
});
