// script.js

// Получаем элементы из DOM
const urlInput = document.getElementById('url-input');
const intervalInput = document.getElementById('interval-input');
const loadButton = document.getElementById('load-button');
const stopButton = document.getElementById('stop-button');
const addUrlButton = document.getElementById('add-url-button');
const urlList = document.getElementById('url-list');
const iframe = document.getElementById('webpage');

// Переменные для хранения URL и интервала
let urls = [];
let currentIndex = 0;
let intervalTime = 5000;
let intervalId;

// Функция для загрузки следующей страницы
function showNextPage() {
    if (urls.length === 0) return;

    const url = urls[currentIndex];

    // Проверяем URL, чтобы он начинался с http:// или https://
    if (!/^https?:\/\//i.test(url)) {
        alert('Пожалуйста, убедитесь, что все URL начинаются с http:// или https://');
        return;
    }

    iframe.src = url;
    currentIndex++;

    if (currentIndex >= urls.length) {
        currentIndex = 0; // Начать с первого URL снова
    }
}

// Функция для начала показа страниц
function startSlideshow() {
    // Получаем интервал из поля ввода
    intervalTime = parseInt(intervalInput.value) * 1000; // Преобразуем в миллисекунды

    if (urls.length === 0) {
        alert('Пожалуйста, введите хотя бы один URL.');
        return;
    }

    // Останавливаем возможные предыдущие интервалы, если они были активны
    if (intervalId) {
        clearInterval(intervalId);
    }

    // Показываем первую страницу сразу
    showNextPage();

    // Устанавливаем интервал для показа следующей страницы
    intervalId = setInterval(showNextPage, intervalTime);
}

// Функция для остановки показа страниц
function stopSlideshow() {
    if (intervalId) {
        clearInterval(intervalId); // Останавливаем текущий интервал
        intervalId = null;
        alert('Показ страниц остановлен.');
    } else {
        alert('Показ страниц уже остановлен.');
    }
}

// Функция для добавления нового URL в список
function addUrlToList() {
    const url = urlInput.value.trim();
    
    if (url && !urls.includes(url)) {
        // Добавляем URL в массив и список на странице
        urls.push(url);
        
        // Создаём элемент списка
        const li = document.createElement('li');
        li.textContent = url;
        urlList.appendChild(li);
        
        // Очищаем поле ввода
        urlInput.value = '';
    } else {
        alert('Пожалуйста, введите корректный URL.');
    }
}

// Обработчик события для кнопки "Добавить ссылку"
addUrlButton.addEventListener('click', addUrlToList);

// Обработчик события для кнопки "Начать показ"
loadButton.addEventListener('click', startSlideshow);

// Обработчик события для кнопки "Остановить показ"
stopButton.addEventListener('click', stopSlideshow);

// Дополнительно: можно загружать страницы по нажатию клавиши Enter
urlInput.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        startSlideshow();
    }
});
