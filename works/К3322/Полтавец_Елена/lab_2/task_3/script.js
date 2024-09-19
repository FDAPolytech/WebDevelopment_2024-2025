// Слушаем событие "DOMContentLoaded", которое происходит когда документ полностью загружен и обработан браузером
document.addEventListener("DOMContentLoaded", function() {
    // Инициализируем массив страниц, индекс текущей страницы и идентификатор интервала
    const pages = [];
    let currentIndex = 0;
    let intervalId;
 
    // Получаем кнопки "Добавить" и "Старт" по их позициям в документе
    const buttonAdd = document.querySelector("button:nth-of-type(1)");
    const buttonStart = document.querySelector("button:nth-of-type(2)");
    // Получаем iframe и список страниц по их идентификаторам
    const iframe = document.getElementById("iframe");
    const pageList = document.getElementById("page-list");
 
    // Добавляем слушатель события "click" на кнопку "Добавить"
    buttonAdd.addEventListener("click", function() {
        // Получаем URL и интервал из соответствующих элементов формы
        const url = document.getElementById("page-url").value;
        const interval = document.getElementById("interval").value;
        
        // Добавляем информацию о новой странице в массив
        pages.push({ url, interval });
        
        // Создаем новый параграф с информацией о странице и добавляем его к списку страниц
        const newPage = document.createElement("p");
        newPage.textContent = `Страница ${pages.length}: ${url} с интервалом ${interval} сек`;
        pageList.appendChild(newPage);
    });
 
    // Добавляем слушатель события "click" на кнопку "Старт"
    buttonStart.addEventListener("click", function() {
        // Сбрасываем текущий индекс и показываем следующую страницу
        currentIndex = 0;
        showNextPage();
        // Устанавливаем интервал для показа следующей страницы на основе интервала текущей страницы
        intervalId = setInterval(showNextPage, pages[currentIndex].interval * 1000);
    });
 
    // Функция для показа следующей страницы
    function showNextPage() {
        // Устанавливаем URL iframe'а на URL текущей страницы
        iframe.src = pages[currentIndex].url;
        // Увеличиваем индекс текущей страницы с учетом цикличности
        currentIndex = (currentIndex + 1) % pages.length;
    }
 });
 