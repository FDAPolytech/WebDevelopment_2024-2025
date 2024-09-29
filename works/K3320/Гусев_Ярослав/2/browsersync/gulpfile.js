const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function serve(done) {
  browserSync.init({
    server: {
      baseDir: './'
    }
  });
  done();
}

function watchFiles() {
  gulp.watch('*.html');
}

exports.default = gulp.series(serve, watchFiles);
