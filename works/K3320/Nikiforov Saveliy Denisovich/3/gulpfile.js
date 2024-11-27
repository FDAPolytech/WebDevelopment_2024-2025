const {src, dest, series, parallel, watch} = require('gulp');

const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const browserSync = require("browser-sync");

function styles() {
    return src('styles.css')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('wordpress/feedback'))
        .pipe(browserSync.stream());
}

function scripts() {
    return src('script.js')
        .pipe(uglify())
        .pipe(dest('wordpress/feedback'))
        .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        proxy: "localhost",
        port: 5432,
        open: true,
        notify: false,
    })
    watch('script.js', scripts)
    watch('style.css', styles)
    watch('wordpress/feedback/*.html', browserSync.reload)
}

exports.styles = styles;
exports.scripts = scripts;
exports.buildSequential = series(styles, scripts);
exports.buildParallel = parallel(styles, scripts);
exports.serve = series(exports.buildParallel, serve);