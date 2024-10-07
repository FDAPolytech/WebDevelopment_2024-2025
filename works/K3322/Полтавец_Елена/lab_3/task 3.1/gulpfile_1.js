const { series, parallel, task, src, dest } = require('gulp');

// Задача 1
function task1(done) {
    console.log('Выполнение задачи 1');
    done();
}

// Задача 2
function task2(done) {
    console.log('Выполнение задачи 2');
    done();
}

// Задача для последовательного выполнения задач 1 и 2
exports.seriesTask = series(task1, task2);

// Задача для параллельного выполнения задач 1 и 2
exports.parallelTask = parallel(task1, task2);

// Задача по умолчанию
// exports.default = series(task1, task2);
exports.default = parallel(task1, task2);
