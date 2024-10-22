const gulp = require('gulp');
const connect = require('gulp-connect-php');
const browserSync = require('browser-sync').create();

function browserSyncTask() {
  connect.server({}, function () {
    browserSync.init({
      proxy: '127.0.0.1:8000'
    });
  });

  gulp.watch('**/*.php').on('change', browserSync.reload);
  gulp.watch('styles.css').on('change', browserSync.reload);
  gulp.watch('script.js').on('change', browserSync.reload);
  gulp.watch('**/*.html').on('change', browserSync.reload);
}

exports.default = browserSyncTask;
