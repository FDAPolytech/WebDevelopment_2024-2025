var gulp = require("gulp"), // подключаем Gulp
  sass = require("gulp-sass")(require("sass")), // подключаем Sass пакет,
  browserSync = require("browser-sync").create(); // подключаем Browser Sync

// Задача для обработки SCSS
gulp.task("sass", function () {
  return gulp
    .src("build/scss/**/*.scss") // берем источник .scss файлов
    .pipe(sass().on("error", sass.logError)) // преобразуем SCSS в CSS
    .pipe(gulp.dest("build/css")) // выгружаем результата в папку app/css
    .pipe(browserSync.reload({ stream: true })); // обновляем CSS на странице при изменении
});

// Задача для запуска BrowserSync
gulp.task("browser-sync", function () {
  browserSync.init({
    server: {
      baseDir: "build", // директория для сервера - app
    },
    notify: false, // отключаем уведомления
  });
});

// Задача для обновления HTML
gulp.task("code", function () {
  return gulp.src("build/*.html").pipe(browserSync.reload({ stream: true }));
});

// Задача для наблюдения за изменениями
gulp.task("watch", function () {
  gulp.watch("build/scss/**/*.scss", gulp.parallel("sass")); // наблюдение за .scss файлами
  gulp.watch("build/*.html", gulp.parallel("code")); // наблюдение за HTML файлами в корне проекта
});

// Задача по умолчанию
gulp.task("default", gulp.parallel("sass", "browser-sync", "watch"));
