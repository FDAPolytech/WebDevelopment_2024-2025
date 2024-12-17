const gulp = require('gulp'); // Подключаем Gulp
const browserSync = require('browser-sync').create(); // Подключаем Browser Sync

// Пути к файлам проекта
const path = {
    html: './*.html'
};

function FirstTask(done) {
    console.log('First task is running...');
    done();
}

function SecondTask(done) {
    console.log('Second task is running...');
    done();
}

function ThirdTask(done) {
    console.log('Third task is running...');
    done();
}

// Таск для последовательного выполнения
const sequentialTask = gulp.series(FirstTask, SecondTask, ThirdTask);

// Таск для параллельного выполнения
const parallelTask = gulp.parallel(FirstTask, SecondTask, ThirdTask);

// Настройка BrowserSync
function serve() {
    browserSync.init({
        server: {
            baseDir: './',
        },
        notify: false,
    });

    gulp.watch(path.html).on('change', browserSync.reload);
    
}

// Экспорт тасков
exports.default = serve; // Запуск сервера по умолчанию
exports.sequential = sequentialTask; // Последовательный запуск задач
exports.parallel = parallelTask; // Параллельный запуск задач