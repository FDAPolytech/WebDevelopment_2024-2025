const form = document.querySelector("form");
form.addEventListener("submit", handleSubmit);

let isDisplaying = false;
let websiteList = [];
let currentPageIndex = 0;
const iframe = document.querySelector("#frame");

function handleSubmit(event) {
  event.preventDefault();

  const url = event.target.querySelector("[name='url']").value;
  const duration = parseInt(event.target.querySelector("[name='duration']").value, 10);

  websiteList.push({ url, duration });

  if (!isDisplaying) {
    isDisplaying = true;
    displayNextPage();
  }

  const urlList = document.querySelector("#sites");
  const newEntry = document.createElement("div");
  newEntry.className = 'site-entry';
  newEntry.textContent = `URL: ${url}, Duration: ${duration}s`;
  urlList.appendChild(newEntry);

  event.target.reset();
}

function displayNextPage() {
  if (websiteList.length === 0) return;
  
  iframe.src = websiteList[currentPageIndex].url;

  setTimeout(() => {
    currentPageIndex = (currentPageIndex + 1) % websiteList.length;
    if (isDisplaying) {
      displayNextPage();
    }
  }, websiteList[currentPageIndex].duration * 1000);
}
