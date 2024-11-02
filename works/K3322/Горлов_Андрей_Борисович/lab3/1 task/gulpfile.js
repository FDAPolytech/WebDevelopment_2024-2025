const gulp = require('gulp');
const browserSync = require('browser-sync').create();
function serve(cb) {
  browserSync.init({
    server: {
      baseDir: './'
    }
  });
  cb();
}
function reload(cb) {
  browserSync.reload();
  cb();
}
function watchFiles() {
  gulp.watch('*.html', reload);
  gulp.watch('css/**/*.css', reload);
  gulp.watch('js/**/*.js', reload);
  gulp.watch('php/**/*.php', reload);
}
const serveAndWatch = gulp.series(serve, watchFiles);
const parallelTasks = gulp.parallel(serve, watchFiles);
exports.serveAndWatch = serveAndWatch;
exports.parallelTasks = parallelTasks;