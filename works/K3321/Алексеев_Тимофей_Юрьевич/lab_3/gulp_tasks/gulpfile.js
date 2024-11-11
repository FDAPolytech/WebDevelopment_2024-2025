var gulp = require('gulp'); 
const browserSync = require('browser-sync').create();

gulp.task('hello', function(done) {
    console.log('Hello, my dear editor!');
    done();
});

gulp.task('bye', function(done) {
    console.log('Bye Bye, my dear editor!');
    done();
});

gulp.task('orderTasks', gulp.series('hello', 'bye'));
gulp.task('parallelTasks', gulp.parallel('hello', 'bye'));

gulp.task('html', function () {
    return gulp.src('app/index.html').pipe(browserSync.stream());
});

gulp.task('scripts', function () {
    return gulp.src('app/script.js').pipe(browserSync.stream());
});

gulp.task('server', function () {
    browserSync.init({
        server: {
            baseDir: 'app'
        }
    });

    gulp.watch('app/index.html',).on('change', browserSync.reload);
    gulp.watch('app/script.js').on('change', browserSync.reload);
});

gulp.task('startWeb', gulp.series(gulp.parallel('html', 'scripts'), 'server'));