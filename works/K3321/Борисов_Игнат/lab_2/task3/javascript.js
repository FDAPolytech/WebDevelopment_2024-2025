urls = [ "first.html" ];
i = 0;
bool = 0;

function add() {
    formURL = document.getElementById("URL");
    urls.push(formURL.value);
    formURL.value = ' ';
    console.log(urls);
}

function next() {
    url = document.getElementById("web-page");
    if (!bool){
        urls.shift()
        bool++;
    } else {
		i = (i+1)%(urls.length)
    }
    url.src = urls[i];
    console.log(i);
}

function prev() {
    url = document.getElementById("web-page");
    if (!bool){
        urls.shift()
        bool++;
    } else {
		i = (i-1 + urls.length)%(urls.length)
    }
    url.src = urls[i];
    console.log(i);
}

function start() {
    interval = setInterval(() => {
		nextPage();}, 
		document.getElementById("time").value*1000)
}

function stop() {
    clearInterval(interval);
}