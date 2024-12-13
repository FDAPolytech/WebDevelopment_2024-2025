const gulp = require('gulp');

gulp.task('task1', function(callback) {
  console.log('Выполняется таск 1');
  for (let i = 0; i < 5; i++) {
    console.log('Я номер ' + i + ' в таске 1');
  }
  callback();
});

gulp.task('task2', function(callback) {
  for (let i = 0; i < 5; i++){
    console.log('Я номер ' + i + ' в таске 2');
  }
  callback();
});

// последовательное выполнение
gulp.task('series', gulp.series('task1', 'task2'));

// параллельное выполнение
gulp.task('parallel', gulp.parallel('task1', 'task2'));