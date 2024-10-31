document.addEventListener("DOMContentLoaded", function() {
    const pages = [];
    let currentIndex = 0;
    let intervalId;

    const temp = [];
 
    const buttonAdd = document.getElementById("add-page");
    const buttonDel = document.getElementById("delete-page");
    const buttonStart = document.getElementById("show-page");
    const iframe = document.getElementById("iframe");
    const pageList = document.getElementById("page-list");
 
    buttonAdd.addEventListener("click", function() {
        const url = document.getElementById("page-url").value;
        const interval = document.getElementById("interval").value;
        
        pages.push({ url, interval });
        
        const newPage = document.createElement("p");
        newPage.textContent = `Страница ${pages.length}: ${url} с интервалом ${interval} сек`;
        pageList.appendChild(newPage);
        temp.push(newPage);
    });

    buttonDel.addEventListener("click", function() {
        clearInterval(intervalId);
        pages.pop();
        pageList.removeChild(temp.pop());
    });
 
    buttonStart.addEventListener("click", function() {
        currentIndex = 0;
        showNextPage();
        intervalId = setInterval(showNextPage, pages[currentIndex].interval * 1000);
    });
 
    function showNextPage() {
        iframe.src = pages[currentIndex].url;
        currentIndex = (currentIndex + 1) % pages.length;
    }
 });
 