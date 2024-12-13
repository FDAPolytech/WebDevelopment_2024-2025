const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('browser-sync', function() {
  browserSync.init({
    server: './',
    files: ['index.html']
  });
});

gulp.task('watch', function() {
  gulp.watch('index.html', browserSync.reload);
});

gulp.task('default', gulp.series('browser-sync', 'watch'));