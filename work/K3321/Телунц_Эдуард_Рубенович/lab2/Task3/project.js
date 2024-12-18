let urls = ["https://ru.wikipedia.org/wiki/%D0%97%D0%B0%D0%B3%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F_%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0"];

let i = 0;
let x;
let interval;

document.getElementById('AddURLbtn').addEventListener('click', function() {
    if (document.getElementById('url_input').value != ''){
        urls.push(document.getElementById('url_input').value);
        document.getElementById('url_input').value = '';
    }
    if (document.getElementById('time_input').value != ''){
        x = Number(document.getElementById('time_input').value);
        document.getElementById('time_input').value = '';
    }
});

function NextSite() {
    i = (i + 1) % urls.length;
    document.getElementById('super_frame').src = urls[i];
}

document.getElementById('NextURLbtn').addEventListener('click', NextSite);

document.getElementById('PreviousURLbtn').addEventListener('click', function() {
    i = (i - 1 + urls.length) % urls.length;
    document.getElementById('super_frame').src = urls[i];
});


function ChangeSite() {
    if (interval) {
        clearInterval(interval);
    }

    NextSite();

    interval = setInterval(NextSite, x*1000);
}

document.getElementById('Startbtn').addEventListener('click', ChangeSite);

document.getElementById('Endbtn').addEventListener('click', function(){
    if (interval) {
        clearInterval(interval);
    }
});