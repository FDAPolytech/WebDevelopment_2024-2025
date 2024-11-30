// Подключаем gulp и browser-sync
const gulp = require("gulp");
const browserSync = require("browser-sync").create();

// Создаем задачу для запуска сервера
gulp.task("browser-sync", function () {
  // Настраиваем сервер
  browserSync.init({
    server: {
      baseDir: "./src", // Указываем корневую директорию сервера как папку src
    },
  });

  // Наблюдаем за изменениями файла index.html в папке src
  gulp.watch("src/index.html").on("change", browserSync.reload); // Автоматическая перезагрузка при изменении HTML
  gulp.watch("src/css/*.css").on("change", browserSync.reload); // Автоперезагрузка при изменении CSS
  gulp.watch("src/js/*.js").on("change", browserSync.reload); // Автоперезагрузка при изменении JS
});

// Задача по умолчанию
gulp.task("default", gulp.series("browser-sync"));
