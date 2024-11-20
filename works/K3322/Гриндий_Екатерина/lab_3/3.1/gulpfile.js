var gulp = require("gulp"),
  sass = require("gulp-sass")(require("sass")),
  browserSync = require("browser-sync").create();

gulp.task("sass", function () {
  return gulp
    .src("build/scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("build/css"))
    .pipe(browserSync.reload({ stream: true }));
});

// Ззапуск BrowserSync
gulp.task("browser-sync", function () {
  browserSync.init({
    server: {
      baseDir: "build",
    },
    notify: false, //уведы
  });
});

// обновляем html
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
