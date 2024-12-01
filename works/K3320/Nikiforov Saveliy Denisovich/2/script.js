const urls = ['https://wikipedia.com', "https://ru.wikipedia.org/wiki/Университет_ИТМО",];

let intervalId;
let currentIndex = 0;

function startSlideshow() {
    const iframe = document.getElementById('webpage-frame');
    const intervalInput = document.getElementById('interval');
    const interval = Math.max(1, parseInt(intervalInput.value)) * 1000;
    alert("Слайдшоу начинается!");
    clearInterval(intervalId);
    iframe.src = urls[currentIndex];
    intervalId = setInterval(() => {
        currentIndex = (currentIndex + 1) % urls.length;
        iframe.src = urls[currentIndex];
    }, interval);
}

function addToSlideshow() {
    const userLink = document.getElementById('user-link');

    if (userLink.value === "") {
        alert("Ссылка не может быть пуста!")
    }

    urls.push(userLink.value);
    userLink.value = "";
}