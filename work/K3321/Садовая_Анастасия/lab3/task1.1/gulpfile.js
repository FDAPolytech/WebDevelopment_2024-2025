const gulp = require('gulp');

gulp.task('first', function(done) {
        console.log('The first task');
        done();
    });

gulp.task('next serial task', function(done) {
        console.log('Next serial task');
        done();
})

gulp.task('parallel task1', function(done) {
        console.log('Parallel task = 1');
        done();
})

gulp.task('parallel task2', function(done) {
        console.log('Parallel task = 2');
        done();
})

gulp.task('default', gulp.series('first', 'next serial task', gulp.parallel('parallel task1', 'parallel task2')));