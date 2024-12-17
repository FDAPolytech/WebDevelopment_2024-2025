const gulp = require('gulp');
const { exec } = require('child_process');

// Задача для запуска программы-клиента
gulp.task('run-client', (cb) => {
  exec('node client.js', (err, stdout, stderr) => {
    if (err) {
      console.error(`Ошибка: ${err.message}`);
    }
    if (stderr) {
      console.error(`Предупреждение: ${stderr}`);
    }
    console.log(stdout);
    cb();
  });
});

// Задача по умолчанию (опционально)
gulp.task('default', gulp.series('run-client'));
