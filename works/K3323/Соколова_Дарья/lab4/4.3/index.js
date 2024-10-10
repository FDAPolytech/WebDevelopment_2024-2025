let data = [];
let currentIndex = 0;
let intervalId = null;

const form = document.querySelector("form");
const inputUrl = document.getElementById("url");
const inputInterval = document.getElementById("interval");
const list = document.querySelector(".list");
const iframe = document.getElementById("iframe");

function showPage() {
  console.log(data[currentIndex]);
  iframe.src = data[currentIndex].url;

  const prevInterval = data[currentIndex].interval;
  const nextIndex = (currentIndex + 1) % data.length;
  currentIndex = nextIndex;

  clearTimeout(intervalId);
  intervalId = setTimeout(showPage, prevInterval);
}

document.getElementById("startButton").addEventListener("click", (e) => {
  e.preventDefault();
  if (intervalId === null) {
    showPage();
  }
});

document.getElementById("addButton").addEventListener("click", (e) => {
  e.preventDefault();
  const url = inputUrl.value;
  const interval = inputInterval.value;
  if (url.length !== 0 && interval.length !== 0) {
    data.push({ url, interval: +interval });

    const p = document.createElement("p");
    p.textContent = `Ссылка с url ${decodeURIComponent(
      url
    )} и интервалом ${interval} мс`;
    list.append(p);

    form.reset();
    inputUrl.focus();
  } else {
    console.log("error");
  }
});

document.getElementById("stopButton").addEventListener("click", () => {
  clearInterval(intervalId);
  intervalId = null;
});
