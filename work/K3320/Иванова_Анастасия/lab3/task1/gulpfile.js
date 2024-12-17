const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('task1', (done) => {
    console.log('Done 1');
    done();
});

gulp.task('task2', (done) => {
    console.log('Done 2');
    done();
});

gulp.task('series', gulp.series('task1', 'task2'));

gulp.task('parallel', gulp.parallel('task1', 'task2'));

function serve() {
    browserSync.init({
        server: {
            baseDir: "."
        }
    });

    gulp.watch('*html').on('change', browserSync.reload);
    gulp.watch('js/*.js').on('change', browserSync.reload);

}

gulp.task('default', gulp.series(serve));