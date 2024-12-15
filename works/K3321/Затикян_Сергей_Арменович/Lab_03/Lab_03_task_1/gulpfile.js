const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('task1', (done) => {
    console.log('Task 1 выполнен!');
    done();
});

gulp.task('task2', (done) => {
    console.log('Task 2 выполнен!');
    done();
});

gulp.task('sequence', gulp.series('task1', 'task2'));
gulp.task('parallel', gulp.parallel('task1', 'task2'));


gulp.task('browser-sync', (done) => {
    browserSync.init({
        server: {
            baseDir: './',
        },
        notify: false,
    });
    done();
});

gulp.task('watch', () => {
    gulp.watch('./*.html').on('change', browserSync.reload);
    gulp.watch('./*.css').on('change', browserSync.reload);
    gulp.watch('./*.js').on('change', browserSync.reload);
});


gulp.task('default', gulp.series('browser-sync', 'watch'));
