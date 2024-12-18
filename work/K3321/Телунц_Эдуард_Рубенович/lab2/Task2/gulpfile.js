const gulp = require('gulp');

gulp.task('copy', function() {
    return gulp.src('../../Lab1/index.html')
        .pipe(gulp.dest('.'))
});

gulp.task('default', gulp.series('copy'));