const gulp = require("gulp");
const cleanCSS = require('gulp-clean-css');

gulp.task('copy', function() {
  return gulp.src('src/*.html')
    .pipe(gulp.dest('dist'));
});

gulp.task('minify-css', function() {
  return gulp.src('src/*.css')   // Source CSS files
    .pipe(cleanCSS())                // Minify CSS
    .pipe(gulp.dest('dist'));    // Output folder
});