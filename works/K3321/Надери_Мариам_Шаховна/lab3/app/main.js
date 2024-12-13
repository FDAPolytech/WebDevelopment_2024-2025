let pages = ['https://cyberleninka.ru', 'https://www.gosuslugi.ru/'];
let interval = 3000;
let nowPage = 0;

function run() {
    const frame = document.getElementById('ID_iframe')
    frame.src = pages[nowPage]
    nowPage = (nowPage + 1) % pages.length;
}

function updateUrls() {
    const newUrl = newURL.value.trim()
    if (newUrl && !pages.includes(newUrl)) {
        pages.push(newUrl)
    } else {
        alert('URL уже есть в списке')
    }
    newURL.value = ''
}

function updateInterval() {
    interval = newInterval.value.trim() * 1000
    if (interval >= 1000) {
        clearInterval(goInterval)
        goInterval = setInterval(run, interval)
    } else {
        alert('Интервал не может быть меньше 1 сек')
    }
    newInterval.value = ''
}

submit1.addEventListener('click', updateUrls);
submit2.addEventListener('click', updateInterval);
goInterval = setInterval(run, interval);
run();
