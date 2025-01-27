let urls = ["first.html"];
let currentIndex = 0;
let interval;

function add() {
    const formURL = document.getElementById("URL");
    urls.push(formURL.value.trim());
    formURL.value = "";
    console.log(urls);
}

function next() {
    const url = document.getElementById("web-page");
    currentIndex = (currentIndex + 1) % urls.length;
    url.src = urls[currentIndex];
    console.log(currentIndex);
}

function prev() {
    const url = document.getElementById("web-page");
    currentIndex = (currentIndex - 1 + urls.length) % urls.length;
    url.src = urls[currentIndex];
    console.log(currentIndex);
}

function start() {
    const time = document.getElementById("time").value;
    if (time > 0) {
        interval = setInterval(next, time * 1000);
    }
}

function stop() {
    clearInterval(interval);
}
