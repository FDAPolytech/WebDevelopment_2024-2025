const gulp = require('gulp');
const htmlmin = require('gulp-htmlmin');

gulp.task('minify-html', function() {
  return gulp.src('*.html')
    .pipe(htmlmin({ collapseWhitespace: true, removeComments: true }))
    .pipe(gulp.dest('dist'));
});

gulp.task('default', gulp.series('minify-html'));