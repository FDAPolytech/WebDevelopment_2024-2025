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

exports.styles = styles;
exports.scripts = scripts;
exports.buildSequential = series(styles, scripts);
exports.buildParallel = parallel(styles, scripts);