const gulp = require('gulp');


gulp.task('copy', () => {
    return gulp.src('src_folder/*.txt')
        .pipe(gulp.dest('dst_folder'));
});

gulp.task('default', gulp.series('copy'));