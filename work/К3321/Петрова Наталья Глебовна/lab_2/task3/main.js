links = [
    "demo.html"
];
myIndex = 0;
flag = 0;

function giveURL() {
    formURL = document.getElementById("URL");
    links.push(formURL.value);
    formURL.value = ' ';
    console.log(links);
}

function nextPage() {
    webPage = document.getElementById("web-page");
    if (flag == 0){
        links.shift()
        flag = 1;
        
    } else {
    myIndex = (myIndex+1)%(links.length)
    }
    webPage.src = links[myIndex];
    console.log(myIndex);
    
    
}

function prevPage() {
    webPage = document.getElementById("web-page");
    if (flag == 0){
        links.shift()
        flag = 1;
    } else {

    myIndex = (myIndex-1 + links.length)%(links.length)
    
    }
    webPage.src = links[myIndex];
    console.log(myIndex);
}

function startAuto() {
    formTime = document.getElementById("time").value;
    doInterval = setInterval(() => {nextPage();}, formTime*1000)

    
}

function stopAuto() {
    clearInterval(doInterval);
}