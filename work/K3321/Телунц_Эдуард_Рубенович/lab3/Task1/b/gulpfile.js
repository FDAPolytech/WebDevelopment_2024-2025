var gulp = require('gulp'); 
var browserSync = require('browser-sync').create();
const sass = require('gulp-sass')(require('sass'));

gulp.task('sass', function compileSass() {
    return gulp
    .src('src/sass/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('src/css'))
    .pipe(browserSync.stream());
});

gulp.task('serve', function () {
    gulp.watch("src/css/*.css", gulp.parallel('sass'));
    gulp.watch("src/html/*.html").on('change', browserSync.reload());
});

gulp.task('init', function Goaaaal() {
    browserSync.init({
        server: "./src/html",
        injectChanges: false
    });
});

gulp.task('default', gulp.series('init', 'serve'));
