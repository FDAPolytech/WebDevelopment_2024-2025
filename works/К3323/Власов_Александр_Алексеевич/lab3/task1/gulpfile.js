const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('task1', function (done) {
    console.log('Выполняется task1...');
    setTimeout(done, 1000);
});

gulp.task('task2', function (done) {
    console.log('Выполняется task2...');
    setTimeout(done, 1000);
});

gulp.task('sequential', gulp.series('task1', 'task2'));

gulp.task('parallel', gulp.parallel('task1', 'task2'));

gulp.task('serve', function () {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });

    gulp.watch("*.html").on('change', browserSync.reload);
    gulp.watch("*.css").on('change', browserSync.reload);
    gulp.watch("*.js").on('change', browserSync.reload);
});

gulp.task('default', gulp.series('serve'));
