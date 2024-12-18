const gulp = require('gulp');

gulp.task('first', function (done) {
    console.log('first task');
    done();
})

gulp.task('second', function (done) {
    console.log('second task');
    done();
})

gulp.task('serial', gulp.series('first', 'second'))
gulp.task('parallel', gulp.parallel('first', 'second'))



