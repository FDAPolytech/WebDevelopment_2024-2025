document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    const formData = new FormData(this); // Собираем данные из формы

    // Преобразуем данные в объект
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // Отправляем данные на сервер
    fetch('https://example.com/api/submit', { // Замените URL на ваш сервер
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data), // Преобразуем объект в JSON
    })
    .then(response => response.json())
    .then(data => {
        console.log('Успех:', data);
        alert('Форма успешно отправлена!');
    })
    .catch((error) => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка при отправке формы.');
    });
});