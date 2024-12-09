// Список web-страниц
const webPages = [
    "https://www.ska.ru/",
    "https://hctraktor.org/",
    "https://www.ak-bars.ru/"
  ];
  
  // Интервал показа web-страниц (в секундах)
  const interval = 5;
  
  // Текущий индекс web-страницы
  let currentIndex = 0;
  
  // Функция для отображения следующей web-страницы
  function showNextPage() {
    const iframe = document.getElementById("web-page");
    iframe.src = webPages[currentIndex];
    currentIndex = (currentIndex + 1) % webPages.length;
  }
  
  // Функция для запуска показа web-страниц
  function startShowingPages() {
    showNextPage();
    setInterval(showNextPage, interval * 1000);
  }
  
  // Запуск показа web-страниц
startShowingPages();


const webPagesInput = document.getElementById("web-pages");
const intervalInput = document.getElementById("interval");
const startButton = document.getElementById("start-button");

startButton.addEventListener("click", () => {
  webPages = webPagesInput.value.split("\n");
  interval = parseInt(intervalInput.value);
  startShowingPages();
});