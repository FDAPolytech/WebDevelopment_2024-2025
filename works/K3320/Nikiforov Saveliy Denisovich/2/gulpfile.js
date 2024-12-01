const {src, dest, watch, parallel} = require('gulp');

const scss = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const browserSync = require('browser-sync').create();


function scripts() {
    return src('script.js')
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(dest('app/js'))
        .pipe(browserSync.stream())
}
function styles() {
    return src('styles.css')
        .pipe(concat('style.min.css'))
        .pipe(scss({outputStyle: 'compressed'}))
        .pipe(dest('app/css'))
        .pipe(browserSync.stream())
}
function build() {
    scripts();
    styles();
}
function watching() {
    watch(['style.css'], styles)
    watch(['script.js'], scripts)
    watch(['./*.html']).on('change', browserSync.reload)
}
function browsersync() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
}
exports.styles = styles;
exports.scripts = scripts;
exports.build = build;
exports.watching = watching;
exports.browsersync = browsersync;
exports.default = parallel(browsersync, watching);