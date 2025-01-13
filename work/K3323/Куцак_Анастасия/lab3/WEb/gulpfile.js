const gulp = require('gulp');

function task1(done) {
    console.log('Task 1 выполнен!');
    done();
}

function task2(done) {
    console.log('Task 2 выполнен!');
    done();
}

// Последовательное выполнение
const sequence = gulp.series(task1, task2);

// Параллельное выполнение
const parallel = gulp.parallel(task1, task2);

exports.sequence = sequence;
exports.parallel = parallel;
 