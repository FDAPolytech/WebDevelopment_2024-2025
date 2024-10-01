var gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('hello', function() {
    console.log('Hello world, this code was written by Timofey!');
});

gulp.task('opener', function () {
    browserSync.init({
        server: {
            baseDir: './app'
        }
    });

    gulp.watch('app/index.html').on('change', browserSync.reload);
    gulp.watch('src/script.js').on('change', browserSync.reload);
});