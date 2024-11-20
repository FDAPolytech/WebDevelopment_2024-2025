document.addEventListener("DOMContentLoaded", function () {
  const pages = [];
  let currentIndex = 0;
  let intervalId;
  const pageElements = [];
  let start = true;

  const buttonAdd = document.getElementById("addPage");
  const buttonStart = document.getElementById("start");
  const buttonDelete = document.getElementById("delete");

  const iframe = document.getElementById("iframe");
  const pageList = document.getElementById("page-list");

  buttonAdd.addEventListener("click", function () {
    const url = document.getElementById("page-url").value;
    const interval = document.getElementById("interval").value;
    if (url && interval) {
      pages.push({ url, interval });

      const newPage = document.createElement("p");
      newPage.textContent = `Страница ${pages.length}: ${url} с интервалом ${interval} сек`;
      pageList.appendChild(newPage);
      pageElements.push(newPage);
    } else {
      alert("Не введено значение!");
    }
  });

  buttonStart.addEventListener("click", function () {
    if (start) {
      if (pages.length === 0) {
        alert("Сначала добавьте страницу!");
        return;
      }
      currentIndex = 0;
      showNextPage();
      intervalId = setInterval(
        showNextPage,
        pages[currentIndex].interval * 1000
      );
      buttonStart.textContent = "Остановить показ";
      buttonStart.style = "color: #e28383";

      start = false;
    } else {
      clearInterval(intervalId);
      start = true;
      buttonStart.textContent = "Начать показ";
      buttonStart.style = "color: white";
    }
  });

  buttonDelete.addEventListener("click", function () {
    if (pages.length > 0) {
      pages.pop();
      const lastPageElement = pageElements.pop();
      pageList.removeChild(lastPageElement);
    }
  });

  function showNextPage() {
    iframe.src = pages[currentIndex].url;
    currentIndex = (currentIndex + 1) % pages.length;
  }
});
