const gulp = require('gulp');

function taskOne(done) {
    let i = 1;
    let interval = setInterval(() => {
        console.log(`Task One - Count: ${i}`);
        i++;
        if (i > 5) {
            clearInterval(interval);
            done();
        }
    }, 500);
}   

function taskTwo(done) {
    let i = 6;
    let interval = setInterval(() => {
        console.log(`Task Two - Count: ${i}`);
        i++;
        if (i > 10) {
            clearInterval(interval);
            done();
        }
    }, 500);
}

// Последовательное выполнение
gulp.task('run-sequential', gulp.series(taskOne, taskTwo));

// Параллельное выполнение
gulp.task('run-parallel', gulp.parallel(taskOne, taskTwo));