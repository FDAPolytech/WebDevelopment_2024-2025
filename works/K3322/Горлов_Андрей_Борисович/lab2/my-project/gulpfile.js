const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Таск для запуска сервера и обновления браузера
gulp.task('serve', function() {
  browserSync.init({
    server: "./"
  });

  gulp.watch("*.html").on('change', browserSync.reload);
});
