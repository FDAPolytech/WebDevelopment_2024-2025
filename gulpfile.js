const gulp = require('gulp');

// Задачи
function task1(done) {
    console.log("Task 1 выполнен");
    done();
}

function task2(done) {
    console.log("Task 2 выполнен");
    done();
}

// Последовательное выполнение
const sequential = gulp.series(task1, task2);

// Параллельное выполнение
const parallel = gulp.parallel(task1, task2);

const browserSync = require('browser-sync').create();
const { watch, series } = gulp;

// Запуск сервера
function serve(done) {
    browserSync.init({
        server: {
            baseDir: "./" // Путь к вашему проекту
        }
    });
    done();
}

// Автообновление браузера
function reload(done) {
    browserSync.reload();
    done();
}

// Наблюдение за файлами
function watchFiles() {
    watch("*.html", reload);
    watch("css/*.css", reload);
    watch("js/*.js", reload);
}

// Задачи
exports.default = series(serve, watchFiles);


