const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// BrowserSync task
gulp.task('browserSync', function() {
    browserSync.init({
        server: {
            baseDir: './'
        },
        files: ['*/*.css', '*.html']
    });
});

// Watch task
gulp.task('watch', gulp.series('browserSync', function() {
    gulp.watch(['*/*.css', '*.html']).on('change', browserSync.reload);
}));

// Default task
gulp.task('default', gulp.series('browserSync'));