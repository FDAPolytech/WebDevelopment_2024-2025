const webDocuments = [
    'https://wiki.com',
    'https://www.google.com',
    'https://leetcode.com/problemset'
];

let index = 0;

const intervalValue = 3000;

const frame = document.querySelector('.frame');

let stop = false;

const startChangePages = () => {
    console.log('start');
    stop = false;
    setTimeout(function tick () {

        if (stop == true) {
            return;
        }

        frame.src = webDocuments[index];
        index = (index + 1) % webDocuments.length;
        setTimeout(tick, intervalValue);

    }, intervalValue);
};

const buttonStart = document.querySelector('.btn-start');
buttonStart.addEventListener('click', startChangePages);

const buttonStop = document.querySelector('.btn-stop');
buttonStop.addEventListener('click', () => {
    stop = true;
    console.log('stop');
});
