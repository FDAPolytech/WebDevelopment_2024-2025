const gulp = require('gulp');
var browserSync = require('browser-sync').create()
const sass = require('gulp-sass')(require('sass'));

function serve() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
}

function styles() {
    return gulp.src('scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
}

function watchFiles() {
    gulp.watch('scss/**/*.scss', styles); 
    gulp.watch("./*.html").on('change', browserSync.reload);
}


exports.default = gulp.series(styles, serve, watchFiles);

