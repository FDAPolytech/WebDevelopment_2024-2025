const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');

// Пути к файлам
const paths = {
    html: './src/**/*.html',
    css: './src/styles/**/*.css',
    js: './src/scripts/**/*.js',
};

// Таск для обработки HTML
function htmlTask() {
    console.log("Task_1")
    return gulp.src(paths.html)
        .pipe(gulp.dest('./dist'))
        .pipe(browserSync.stream());
}

// Таск для обработки CSS
function cssTask() {
    console.log("Task_2")
    return gulp.src(paths.css)
        .pipe(concat('style.min.css'))
        .pipe(gulp.dest('./dist/styles'))
        .pipe(browserSync.stream());
}

// Таск для обработки JS
function jsTask() {
    console.log("Task_3")
    return gulp.src(paths.js)
        .pipe(concat('script.min.js'))
        .pipe(gulp.dest('./dist/scripts'))
        .pipe(browserSync.stream());
}

// Таск для запуска BrowserSync
function serve() {
    browserSync.init({
        server: {
            baseDir: './dist',
        },
    });

    // Наблюдение за файлами
    gulp.watch(paths.html, htmlTask);
    gulp.watch(paths.css, cssTask);
    gulp.watch(paths.js, jsTask);
}

// Последовательное выполнение
const build = gulp.series(htmlTask, cssTask, jsTask);

// Параллельное выполнение
const dev = gulp.parallel(htmlTask, cssTask, jsTask, serve);

exports.build = build;
exports.dev = dev;
exports.default = dev;
