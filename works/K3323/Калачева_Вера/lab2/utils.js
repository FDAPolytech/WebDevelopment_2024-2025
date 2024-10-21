let urlList = [];

function addUrl() {
    const urlInput = document.getElementById('urlInput');
    const url = urlInput.value.trim();

    if (url !== '') {
        urlList.push(url);
        renderUrlList();
        urlInput.value = '';
    }
}

function renderUrlList() {
    const urlListElement = document.getElementById('urlList');
    urlListElement.innerHTML = '';

    urlList.forEach((url, index) => {
        const li = document.createElement('li');
        li.textContent = url;
        li.style.cursor = 'pointer';
        li.onclick = () => removeUrl(index);
        urlListElement.appendChild(li);
    });
}

function removeUrl(index) {
    urlList.splice(index, 1);
    renderUrlList();
}

function startProcess() {
    const delayInput = document.getElementById('delayInput');
    const delay = parseInt(delayInput.value);

    if (!isNaN(delay) && delay > 0) {
        urlList.forEach((url, index) => {
            setTimeout(() => {
                openTab(url);
            }, delay * 1000 * (index + 1));
        });
    } else {
        alert('Пожалуйста, введите корректное значение интервала показа.');
    }
}

function openTab(url) {
    window.open(url, '_blank');
}
