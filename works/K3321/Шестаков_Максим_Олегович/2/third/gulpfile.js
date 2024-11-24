const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('default', function() {
    browserSync.init({
        server: './'
    });

    gulp.watch('index.html').on('change', browserSync.reload);
    gulp.watch('./css/third.css').on('change', browserSync.reload);
    gulp.watch('./pages.json').on('change', browserSync.reload);
    gulp.watch('./js/third.js').on('change', browserSync.reload);
});