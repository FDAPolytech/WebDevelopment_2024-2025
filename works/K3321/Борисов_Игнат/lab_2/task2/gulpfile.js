const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('task1', function(done) {
    console.log('Task 1 completed');
    done();
});

gulp.task('task2', function(done) {
    console.log('Task 2 completed');
    done();
});

gulp.task('sequential', gulp.series('task1', 'task2'));

gulp.task('parallel', gulp.parallel('task1', 'task2'));

gulp.task('serve', function(done) {
    browserSync.init({
        server: {
            baseDir: './'
        },
        notify: false
    });

    gulp.watch('*.html').on('change', browserSync.reload);
    gulp.watch('*.css').on('change', browserSync.reload);
    gulp.watch('*.js').on('change', browserSync.reload);

    done();
});

gulp.task('default', gulp.series('serve'));
