let pages = [
  { url: "https://cat-bounce.com/", interval: 5000 },
  { url: "https://thesecatsdonotexist.com", interval: 5000 },
];

let currentIndex = 0;
const viewer = document.getElementById("viewer");
let currentInterval = pages[currentIndex].interval;

function showNextPage() {
  viewer.src = pages[currentIndex].url;
  currentInterval = pages[currentIndex].interval;
  console.log(viewer.src, pages[currentIndex].interval)
  currentIndex = (currentIndex + 1) % pages.length;
  setTimeout(showNextPage, currentInterval);
}

document.getElementById("addPageBtn").addEventListener("click", function () {
  const urlInput = document.getElementById("urlInput");
  const intervalInput = document.getElementById("intervalInput");
  const newUrl = urlInput.value.trim();
  const newInterval = parseInt(intervalInput.value.trim(), 10);

  if (newUrl && !isNaN(newInterval) && newInterval > 0) {
    pages.push({ url: newUrl, interval: newInterval });
    urlInput.value = "";
    intervalInput.value = "";
    alert("Страница добавлена!");
  } else {
    alert("Пожалуйста введите валидный URL и интервал.");
  }
});

setTimeout(showNextPage, currentInterval);
