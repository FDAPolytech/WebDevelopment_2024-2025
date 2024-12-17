document.addEventListener("DOMContentLoaded", function() {
    let urlList = [];
    const urlInput = document.getElementById("url-input");
    const intervalInput = document.getElementById("interval-input");
    const addUrlBtn = document.getElementById("add-url-btn");
    const urlListContainer = document.getElementById("url-list");
    const iframe = document.getElementById("webpage-viewer");

    let currentIndex = 0;
    let slideshowInterval;

    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (_) {
            return false;
        }
    }

    function addUrl(url) {
        if (isValidUrl(url)) {
            urlList.push(url);
            displayUrls();
            if (isValidInterval()) {
                startSlideshow();
            }
        } else {
            alert("Некорректный URL");
        }
    }

    function displayUrls() {
        urlListContainer.innerHTML = "";
        urlList.forEach((url, index) => {
            const listItem = document.createElement("li");
            listItem.innerHTML = `
                <span>${url}</span>
                <button onclick="removeUrl(${index})">Удалить</button>
            `;
            urlListContainer.appendChild(listItem);
        });
    }

    window.removeUrl = function(index) {
        urlList.splice(index, 1);
        displayUrls();
        if (urlList.length === 0) {
            iframe.src = '';
            iframe.style.display = 'none';
            stopSlideshow();
        }
    };

    function isValidInterval() {
        const intervalValue = intervalInput.value.trim();
        return !(intervalValue === "" || isNaN(intervalValue) || intervalValue <= 0);
    }

    function startSlideshow() {
        clearInterval(slideshowInterval);
        const intervalValue = intervalInput.value.trim();

        if (!isValidInterval()) {
            alert("Интервал должен быть целым числом больше 0");
            return;
        }

        function showNextPage() {
            const url = urlList[currentIndex];
            iframe.src = url;

            iframe.onload = function() {
                iframe.style.display = 'block';
            };

            currentIndex = (currentIndex + 1) % urlList.length;
            slideshowInterval = setTimeout(showNextPage, intervalValue * 1000);
        }

        showNextPage();
    }

    function stopSlideshow() {
        clearTimeout(slideshowInterval);
        iframe.src = "";
        iframe.style.display = "none";
        currentIndex = 0;
    }

    addUrlBtn.addEventListener("click", function() {
        const url = urlInput.value;
        if (url) {
            addUrl(url);
            urlInput.value = "";
        } else {
            alert("Пожалуйста, введите URL.");
        }
    });

    intervalInput.addEventListener("input", function() {
        if (isValidInterval()) {
            startSlideshow();
        } else {
            stopSlideshow();
        }
    });
});
