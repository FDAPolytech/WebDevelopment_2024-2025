const gulp = require('gulp');
const browserSync = require('browser-sync').create();


gulp.task('task1', (done) => {
    console.log('Task 1 выполнен');
    done();
});


gulp.task('task2', (done) => {
    console.log('Task 2 выполнен');
    done();
});


gulp.task('series', gulp.series('task1', 'task2'));


gulp.task('parallel', gulp.parallel('task1', 'task2'));


function serve() {
    browserSync.init({
        server: {
            baseDir: 'C:/Users/dns/Desktop/итмо/5 семестр/веб/лаб 3/my-gulp-project' 
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
    gulp.watch('css/*.css').on('change', browserSync.reload);
    gulp.watch('js/*.js').on('change', browserSync.reload);
}

gulp.task('default', gulp.series(serve));
