const gulp = require('gulp');

gulp.task('first-counter', gulp.parallel(function(cb) {
  for (let i = 0; i < 10000000000; i++) {
    continue
  }
  cb();
}));

gulp.task('second-counter', gulp.parallel(function(cb) {
  for (let i = 0; i < 10000000000; i++) {
    continue;
  }
  cb();
}));


const browserSync = require('browser-sync').create();

gulp.task('default', function() {
  browserSync.init({
    server: './'
  });

  gulp.watch('./index.html').on('change', browserSync.reload);
  gulp.watch('./css/second.css').on('change', browserSync.reload);
});


gulp.task('counters', gulp.series('first-counter', 'second-counter'));

