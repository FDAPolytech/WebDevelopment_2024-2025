const urlInput = document.getElementById('url');
const intervalInput = document.getElementById('interval');
const addButton = document.getElementById('add');
const startButton = document.getElementById('start');
const stopButton = document.getElementById('stop');
const pageList = document.getElementById('page-list');
const viewer = document.getElementById('viewer');
let pages = [];
let rotationInterval = null;
addButton.addEventListener('click', () => {
  const url = urlInput.value.trim();
  if (url) {
    pages.push(url);
    const listItem = document.createElement('li');
    listItem.textContent = url;
    pageList.appendChild(listItem);
    urlInput.value = '';
  }
});
startButton.addEventListener('click', () => {
  if (pages.length === 0) {
    alert('Please add at least one URL to the list.');
    return;
  }

  const interval = parseInt(intervalInput.value, 10);
  if (isNaN(interval) || interval <= 0) {
    alert('Please enter a valid interval.');
    return;
  }

  let currentPageIndex = 0;

  if (rotationInterval) clearInterval(rotationInterval);

  rotationInterval = setInterval(() => {
    viewer.src = pages[currentPageIndex];
    currentPageIndex = (currentPageIndex + 1) % pages.length;
  }, interval);
});
stopButton.addEventListener('click', () => {
  if (rotationInterval) {
    clearInterval(rotationInterval);
    rotationInterval = null;
    viewer.src = '';
  }
});
