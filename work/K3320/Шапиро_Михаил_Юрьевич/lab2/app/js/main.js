// Список веб-страниц для показа
let pages = [
    "https://itmo.ru/",
    "https://student.itmo.ru/ru/",
    "https://news.itmo.ru/ru/"
];

// Интервал в миллисекундах (по умолчанию 5 секунд)
let interval = 3000;

let currentPageIndex = 0;
let intervalId = null;
const infoDiv = document.getElementById('info');
const iframe = document.getElementById('webpage');

// Функция для показа следующей страницы
function showPage(index) {
    iframe.src = pages[index];
    infoDiv.innerHTML = `Открыта страница: ${pages[index]}`;
}

// Функция для показа следующей страницы в списке
function showNextPage() {
    currentPageIndex = (currentPageIndex + 1) % pages.length;
    showPage(currentPageIndex);
}

// Функция для показа предыдущей страницы
function showPreviousPage() {
    currentPageIndex = (currentPageIndex - 1 + pages.length) % pages.length;
    showPage(currentPageIndex);
}

// Функция для добавления нового URL в список страниц
function addNewPage() {
    const urlInput = document.getElementById('url-input');
    const newUrl = urlInput.value.trim();

    if (newUrl && isValidUrl(newUrl)) {
        pages.push(newUrl);
        urlInput.value = ""; // Очищаем поле ввода
        alert(`Сайт ${newUrl} добавлен в список!`);
    } else {
        alert("Введите корректный URL!");
    }
}

// Функция для проверки корректности URL
function isValidUrl(url) {
    try {
        new URL(url);
        return true;
    } catch (_) {
        return false;
    }
}

// Функция для задания нового интервала
function setNewInterval() {
    const intervalInput = document.getElementById('interval-input');
    const newInterval = parseInt(intervalInput.value) * 1000;

    if (newInterval && newInterval > 0) {
        interval = newInterval;
        clearInterval(intervalId);  // Останавливаем текущий интервал
        intervalId = setInterval(showNextPage, interval);  // Устанавливаем новый интервал
        alert(`Интервал изменен на ${newInterval / 1000} секунд`);
    } else {
        alert("Введите корректное значение интервала в секундах!");
    }
}

// Назначаем обработчики событий кнопкам
document.getElementById('next-button').addEventListener('click', showNextPage);
document.getElementById('back-button').addEventListener('click', showPreviousPage);
document.getElementById('add-url-button').addEventListener('click', addNewPage);
document.getElementById('set-interval-button').addEventListener('click', setNewInterval);

// Запуск автоматической смены страниц
intervalId = setInterval(showNextPage, interval);
