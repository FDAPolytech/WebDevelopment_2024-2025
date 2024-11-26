const { src, dest, series, parallel, watch } = require('gulp');

const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

// Задача для обработки styles
function styles() {
    return src('app/scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('app/css'))
        .pipe(browserSync.stream());;
}

// Задача для обработки JS
function scripts() {
    return src('app/js/just.js')
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(dest('app/js'))
        .pipe(browserSync.stream());
}

// Задача для инициализации BrowserSync
function serve() {
    browserSync.init({
        proxy: "localhost",
        open: true,
        notify: false
    });
    watch('app/scss/styles.scss', styles);
    watch('app/js/just.js', scripts);
    watch('app/*.html').on('change', browserSync.reload);
}


// Экспорт задач
exports.styles = styles;
exports.scripts = scripts;
exports.buildSequential = series(styles, scripts);
exports.buildParallel = parallel(styles, scripts);
exports.serve = series(parallel(styles, scripts), serve);
