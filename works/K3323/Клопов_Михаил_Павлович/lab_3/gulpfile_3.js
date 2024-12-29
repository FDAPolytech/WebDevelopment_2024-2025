const gulp = require('gulp');
const browserSync = require('browser-sync').create();



  
function watch() {
  browserSync.init({
    server: {
      baseDir: './'
    },
    startPath: 'ex7.html'
  });

  gulp.watch('ex7.html').on('change', browserSync.reload);
}
exports.default = watch;

