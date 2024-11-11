// Получаем элементы DOM
const urlInput = document.getElementById('urlInput');
const intervalInput = document.getElementById('intervalInput');
const addPageButton = document.getElementById('addPageButton');
const pagesList = document.getElementById('pagesList');
const startSlideshowButton = document.getElementById('startSlideshowButton');
const stopSlideshowButton = document.getElementById('stopSlideshowButton');
const iframe = document.getElementById('iframe');

let pages = [];
let currentPageIndex = 0;
let intervalId = null;

// Функция для обновления списка страниц
function updatePagesList() {
    pagesList.innerHTML = ''; // Очищаем список
    pages.forEach((page, index) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
            <a href="${page.url}" target="_blank">${page.url}</a>
            <button class="removeButton" data-index="${index}">Remove</button>
        `;
        pagesList.appendChild(listItem);
    });

    // Добавляем обработчик для кнопок удаления
    const removeButtons = document.querySelectorAll('.removeButton');
    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            removePage(index);
        });
    });
}

// Функция для добавления страницы
function addPage() {
    const url = urlInput.value.trim();
    const interval = parseInt(intervalInput.value.trim(), 10);

    if (url && !isNaN(interval) && interval > 0) {
        pages.push({ url, interval });
        updatePagesList();

        // Очищаем поля ввода
        urlInput.value = '';
        intervalInput.value = '';
    } else {
        alert('Please enter a valid URL and interval.');
    }
}

// Функция для удаления страницы
function removePage(index) {
    pages.splice(index, 1);
    updatePagesList();
}

// Функция для старта слайдшоу
function startSlideshow() {
    if (pages.length === 0) {
        alert('No pages to show!');
        return;
    }

    // Отключаем добавление и старт
    addPageButton.disabled = true;
    startSlideshowButton.disabled = true;
    stopSlideshowButton.disabled = false;

    // Запуск слайдшоу
    showPage();
    intervalId = setInterval(showPage, pages[currentPageIndex].interval * 1000);
}

// Функция для остановки слайдшоу
function stopSlideshow() {
    clearInterval(intervalId);
    intervalId = null;

    // Включаем кнопки обратно
    addPageButton.disabled = false;
    startSlideshowButton.disabled = false;
    stopSlideshowButton.disabled = true;
}

// Функция для показа страницы
function showPage() {
    const page = pages[currentPageIndex];
    iframe.src = page.url;  // Обновляем src для отображения страницы

    // Переключаем на следующую страницу
    currentPageIndex = (currentPageIndex + 1) % pages.length;
}

// Привязываем события к кнопкам
addPageButton.addEventListener('click', addPage);
startSlideshowButton.addEventListener('click', startSlideshow);
stopSlideshowButton.addEventListener('click', stopSlideshow);
