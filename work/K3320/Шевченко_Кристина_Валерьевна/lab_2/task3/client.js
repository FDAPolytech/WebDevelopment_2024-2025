(async () => {
    const open = (await import('open')).default;
  
    const pages = [
      'https://example.com',
      'https://example.org',
      'https://example.net',
    ];
  
    let currentIndex = 0;
    const interval = 5000; // Интервал переключения в миллисекундах (5 секунд)
  
    // Функция для показа текущей страницы
    function showPage() {
      const url = pages[currentIndex];
      console.log(`Открываем страницу: ${url}`);
      open(url); // Открываем страницу в браузере
      currentIndex = (currentIndex + 1) % pages.length; // Переход к следующей странице
    }
  
    // Запускаем цикл показа страниц
    setInterval(showPage, interval);
  })();
  