document.getElementById('feedback-form').addEventListener('submit', function (e) {
    const firstName = document.getElementById('first_name').value.trim();
    const lastName = document.getElementById('last_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const feedback = document.getElementById('feedback').value.trim();

    if (!firstName || !lastName || !email || !feedback) {
        e.preventDefault();
        alert('Пожалуйста, заполните все обязательные поля.');
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        e.preventDefault();
        alert('Введите корректный адрес электронной почты.');
        return;
    }

    alert('Спасибо за вашу обратную связь!');
});