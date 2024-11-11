var gulp = require('gulp'); 

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