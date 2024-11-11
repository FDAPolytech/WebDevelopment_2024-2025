const gulp = require('gulp');

// Задача для приветствия
gulp.task('greet', function(done) {
  console.log('Hello from Gulp!');
  done();
});

// Задача для вывода времени
gulp.task('time', function(done) {
  const currentTime = new Date().toLocaleTimeString();
  console.log(`Current time is: ${currentTime}`);
  done();
});