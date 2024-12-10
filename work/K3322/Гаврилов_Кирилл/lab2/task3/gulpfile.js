const gulp = require('gulp');
const open = require('gulp-open');
const inquirer = require('inquirer');

let urls = [];
let interval = 5000;
let currentUrlIndex = 0;

async function getUserInput() {
    const answers = await inquirer.prompt([
        {
            type: 'input',
            name: 'urls',
            message: 'Введите URL через запятую:',
            filter: input => input.split(',').map(url => url.trim()),
            validate: input => input.length ? true : 'Список URL не может быть пустым'
        },
        {
            type: 'input',
            name: 'interval',
            message: 'Введите интервал между показами в миллисекундах:',
            default: '5000',
            validate: input => !isNaN(input) && Number(input) > 0 ? true : 'Интервал должен быть положительным числом'
        }
    ]);
    urls = answers.urls;
    interval = Number(answers.interval);
}

function openPage(done) {
    if (currentUrlIndex < urls.length) {
        gulp.src(__filename)
            .pipe(open({ uri: urls[currentUrlIndex] }));
        currentUrlIndex++;
    } else {
        clearInterval(intervalId);
        console.log('Все страницы были открыты.');
        process.exit(0);
    }
}

async function start() {
    await getUserInput();
    intervalId = setInterval(openPage, interval);
}

exports.default = start;