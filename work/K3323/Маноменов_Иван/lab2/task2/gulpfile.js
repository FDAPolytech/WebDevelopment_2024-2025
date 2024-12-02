const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve', function() {
  browserSync.init({
    server: "./"
  });

  gulp.watch("*.html").on('change', browserSync.reload);
});

gulp.task('greetings', function(done) {
  console.log('Hello, World!');
  done();
});

gulp.task('default', gulp.series('serve'));