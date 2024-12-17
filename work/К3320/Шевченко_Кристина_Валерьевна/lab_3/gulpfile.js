const { series, parallel, watch } = require('gulp');
const browserSync = require('browser-sync').create();

// Пример тасков
function taskOne(cb) {
    console.log('Task One is running...');
    cb();
}

function taskTwo(cb) {
    console.log('Task Two is running...');
    cb();
}

// Настройка Browsersync
function serve(cb) {
    browserSync.init({
        server: {
            baseDir: "./" // Базовая директория для запуска проекта
        }
    });
    cb();
}

// Таск для наблюдения за изменениями файлов
function watchFiles() {
    watch("*.html").on('change', browserSync.reload);
    watch("css/*.css").on('change', browserSync.reload);
    watch("js/*.js").on('change', browserSync.reload);
}

// Экспорт тасков
exports.default = series(taskOne, taskTwo, serve, watchFiles); // Последовательное выполнение с запуском сервера
exports.parallelTasks = parallel(taskOne, taskTwo, serve, watchFiles); // Параллельное выполнение с запуском сервера
