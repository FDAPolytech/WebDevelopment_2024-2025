const { series, parallel, task, src, dest } = require("gulp");

function taskOne(done) {
  let i = 1;
  let interval = setInterval(() => {
    console.log(i);
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
    console.log(i);
    i++;
    if (i > 10) {
      clearInterval(interval);
      done();
    }
  }, 500);
}

// Задача для последовательного выполнения задач 1 и 2
exports.seriesTask = series(taskOne, taskTwo);

// Задача для параллельного выполнения задач 1 и 2
exports.parallelTask = parallel(taskOne, taskTwo);

// Задача по умолчанию
exports.default = series(taskOne, taskTwo);
// exports.default = parallel(task1, task2);
