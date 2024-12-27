var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var browserSync = require('browser-sync').create();

gulp.task('styles', function() {
  return gulp.src('app/scss/**/*.scss') // Получает все файлы с расширением .scss из папки app/scss
    .pipe(sass())
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({
      stream: true
    }))
});

gulp.task('browser_task', function() {
  browserSync.init({
    server: {
      baseDir: 'app'
    },
  });
  gulp.watch('app/css/**/*.css').on('change', browserSync.reload); //gulp.series('styles')
  gulp.watch('app/*.html').on('change', browserSync.reload);
})

gulp.task('default', gulp.series('styles', 'browser_task')); 