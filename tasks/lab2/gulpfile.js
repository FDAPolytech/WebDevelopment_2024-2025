const gulp = require('gulp');

gulp.task('greet', function(done) {
  console.log('Hello from Gulp!');
  done();
});

gulp.task('time', function(done) {
  const currentTime = new Date().toLocaleTimeString();
  console.log(`Current time is: ${currentTime}`);
  done();
});