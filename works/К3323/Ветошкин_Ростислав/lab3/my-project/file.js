document.addEventListener("DOMContentLoaded", function() {
    const button = document.getElementById('action-button');
    const message = document.getElementById('message');

    button.addEventListener('click', function() {
        message.textContent = "You clicked the button! Magic happened!";
        button.textContent = "Clicked!";
        button.style.backgroundColor = '#28a745';
    });
});