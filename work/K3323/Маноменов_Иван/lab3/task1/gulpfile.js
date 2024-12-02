const gulp = require('gulp')
const browser_sync = require('browser-sync').create();


gulp.task('delay1', (done) => {
  setTimeout(() => {
      console.log('first task completed');
      done(); 
  }, 100); 
});

gulp.task('delay2', (done) => {
  setTimeout(() => {
      console.log('secondtask completed');
      done();
  }, 500); 
});

function serve() {
  browser_sync.init({
    server: "./"
  });

  gulp.watch("*.css").on('change', browser_sync.reload);
  gulp.watch("*.html").on('change', browser_sync.reload);
};

gulp.task('sequence', gulp.series('delay1', 'delay2'));
gulp.task('parallel', gulp.parallel('delay1', 'delay2'));
gulp.task('default', serve);


