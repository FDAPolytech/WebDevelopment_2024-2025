const gulp = require("gulp");
const browserSync = require('browser-sync').create()

gulp.task("hello", function (done) {
  console.log("Hello, Gulp!");
  done();
});

gulp.task('serve', function() {
  browserSync.init({
    server: {
        baseDir: "./"
    }
  });

  gulp.watch('index.html').on('change', browserSync.reload);
  gulp.watch('styles.css').on('change', browserSync.reload);
  gulp.watch('script.js').on('change', browserSync.reload);
});

gulp.task('default', gulp.series('serve'));
