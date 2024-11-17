const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Таск для копирования HTML файлов
function copyHTML() {
    return gulp.src('./*.html')
        .pipe(gulp.dest('./dist'))
        .pipe(browserSync.stream());
}

// Таск для копирования CSS файлов
function copyCSS() {
    return gulp.src('./*.css')
        .pipe(gulp.dest('./dist'))
        .pipe(browserSync.stream());
}

// Таск для запуска BrowserSync и наблюдения за файлами
function serve() {
    browserSync.init({
        server: {
            baseDir: './dist'
        }
    });

    // Следим за изменениями в файлах
    gulp.watch('./*.html', copyHTML);
    gulp.watch('./*.css', copyCSS);
}

// Последовательное выполнение тасков
const seriesTasks = gulp.series(copyHTML, copyCSS);

// Параллельное выполнение тасков
const parallelTasks = gulp.parallel(copyHTML, copyCSS);

// Экспортируем таски
exports.seriesTasks = seriesTasks;
exports.parallelTasks = parallelTasks;
exports.serve = gulp.series(parallelTasks, serve);
