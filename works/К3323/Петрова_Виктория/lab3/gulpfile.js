const gulp = require('gulp');

// Пример первого таска
gulp.task('task1', (done) => {
    console.log('Task 1 выполнен!');
    done();
});

// Пример второго таска
gulp.task('task2', (done) => {
    console.log('Task 2 выполнен!');
    done();
});

// Последовательное выполнение
gulp.task('sequence', gulp.series('task1', 'task2'));

// Параллельное выполнение
gulp.task('parallel', gulp.parallel('task1', 'task2'));
