const gulp = require('gulp');
const browserSync = require('browser-sync').create();
// const { BrowserWindow } = require('electron');
const open = require('gulp-open');
const readline = require('readline');


function hello(cb) {
    console.log('Привет, мир!');
    cb();
  }
  
// Новая задача для BrowserSync(отслеживание изменения в файлах директории track) + отображ. изменений в реальном времени в браузере 
function serve() {
    browserSync.init({
      server: './track' // Здесь указываем директорию, которую будет обслуживать BrowserSync
    });

    // Отслеживаем изменения в файлах 
    gulp.watch('./track/*.html').on('change', browserSync.reload);
  }



function openPage(url) {
  gulp.src(__filename)
    .pipe(open({uri: url}));
};

async function openPagesWithDelay() {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  console.log('Введите список URL, разделенных пробелами:');
  const input1 = await new Promise((resolve) => {
    rl.question('', (answer) => resolve(answer));
  });
  urls = input1.split(/\s+/).map(url => url.trim());

  console.log('Введите задержку в секундах:');
  const input2 = await new Promise((resolve) => {
    rl.question('', (answer) => resolve(answer));
  });
  delay = parseInt(input2) * 1000;


  for (let i = 0; i < urls.length; i++) {
        const url = urls[i];
        await openPage(url);
        console.log(`Страница открыта. Ожидаю ${delay} миллисекунд...`);
        await new Promise(resolve => setTimeout(resolve, delay));
      }
  rl.close();

}

exports.hello = hello;
exports.serve = serve;
exports.pages = openPagesWithDelay;
exports.default = exports.pages;
