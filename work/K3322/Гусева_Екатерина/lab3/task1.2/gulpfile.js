const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('update', function () {
    browserSync.init({
        server: {
            baseDir: './'
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
    gulp.watch('*.css').on('change', browserSync.reload);
    gulp.watch('*.js').on('change', browserSync.reload);
});

 