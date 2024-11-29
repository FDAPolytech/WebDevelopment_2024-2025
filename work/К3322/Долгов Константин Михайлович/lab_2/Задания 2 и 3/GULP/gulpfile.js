const gulp = require('gulp');
const connect = require('gulp-connect');

gulp.task('hello', function(done) {
    console.log('Hello, it works!');
    done();
});

gulp.task('connect', () => {
    connect.server({
        root: 'src',
        livereload: true,
        port: 8080
    });
});

gulp.task('reload', () => {
    return gulp.src('./src/**/*.*')
        .pipe(connect.reload());
});

gulp.task('watch', () => {
    gulp.watch('./src/**/*.*', gulp.series('reload'));
});

gulp.task('default', gulp.parallel('connect', 'watch'));
