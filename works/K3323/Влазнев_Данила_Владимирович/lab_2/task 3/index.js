let form = document.querySelector("form");
form.addEventListener("submit", onSubmit);

let isShowing = false;
let pages = [];
let currentIndex = 0;
let iframe = document.querySelector("#frame");

function onSubmit(event) {
  event.preventDefault();

  let list = document.querySelector("#site-list");

  let newLine = document.createElement("div");
  newLine.textContent = event.target[0].value;

  list.appendChild(newLine);
  pages.push({ url: event.target[0].value, time: event.target[1].value })

  if (!isShowing) {
    isShowing = true;
    showNextPage();
  }

  event.target.reset();
}

function showNextPage() {
  iframe.src = pages[currentIndex].url;
  setTimeout(() => {
    currentIndex = (currentIndex + 1) % pages.length;
    showNextPage();
  }, pages[currentIndex].time * 1000);
}