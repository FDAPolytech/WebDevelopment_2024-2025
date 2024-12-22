const { src, watch, series, parallel } = require('gulp');
const browserSync = require('browser-sync').create();


// Задача: вывод текста в консоль
function logText(done) {
    console.log("Привет, это задача Gulp!");
    done(); // 
}

// Задача: сложение чисел
function addNumbers(done) {
    const a = 5;
    const b = 7;
    console.log(`Сумма чисел ${a} и ${b} равна ${a + b}`);
    done(); 
}



// Задача: запуск локального сервера
function serve(done) {
    browserSync.init({
        server: {
            baseDir: './', 
        },
        port: 3000, 
    });
    done();
}

// Задача: перезагрузка браузера
function reload(done) {
    browserSync.reload();
    done();
}

// Задача: отслеживание изменений
function watchFiles() {
    watch('./*.html', reload); // Отслеживание HTML файлов
    watch('./css/*.css', reload); // Отслеживание CSS файлов
    watch('./js/*.js', reload); // Отслеживание JS файлов
}



// Последовательное выполнение задач
const runInSeries = series(logText, addNumbers, serve, watchFiles);

// Параллельное выполнение задач
const runInParallel = parallel(logText, addNumbers, series(serve, watchFiles));



exports.logText = logText;
exports.addNumbers = addNumbers;
exports.serve = serve;
exports.reload = reload;
exports.watchFiles = watchFiles;
exports.runInSeries = runInSeries;
exports.runInParallel = runInParallel;


exports.default = runInSeries;
