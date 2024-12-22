import open from 'open';  // Используем импорт для модуля open

// Список сайтов для открытия
const sites = [
  "https://www.example.com",
  "https://www.wikipedia.org",
  "https://www.python.org"
];

// Интервал в миллисекундах (5 секунд)
const interval = 5000;

// Задача для открытия сайтов с использованием open
export const openSites = (done) => {
  let index = 0;

  // Функция для открытия следующего сайта
  function openNextSite() {
    if (index < sites.length) {
      // Открываем сайт в браузере
      open(sites[index]);

      console.log(`Открываю сайт: ${sites[index]}`);

      // Переход к следующему сайту через заданный интервал
      index++;
      setTimeout(openNextSite, interval);
    } else {
      console.log('Все сайты были открыты!');
      done(); // Завершаем задачу
    }
  }

  // Начинаем с первого сайта
  openNextSite();
};
