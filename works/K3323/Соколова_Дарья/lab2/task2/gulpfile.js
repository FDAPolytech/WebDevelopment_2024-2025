const gulp = require("gulp");
var browserSync = require("browser-sync").create();
const pug = require("gulp-pug");
const sass = require("gulp-sass")(require("sass"));

gulp.task("hello", function (done) {
  console.log("Hello, Gulp!");
  done(); // Указание, что таск завершен
});

// Таск для преобразования Pug в HTML
gulp.task("pug", function () {
  return gulp
    .src("src/*.pug")
    .pipe(pug())
    .pipe(gulp.dest("build/"))
    .pipe(browserSync.stream());
});

// Таск для преобразования SCSS в CSS
gulp.task("scss", function () {
  return gulp
    .src("src/*.scss")
    .pipe(sass())
    .pipe(gulp.dest("build/"))
    .pipe(browserSync.stream());
});

// Таск для запуска BrowserSync
gulp.task("browser-sync", function () {
  browserSync.init({
    server: {
      baseDir: "./build",
    },
  });
  // Наблюдение за изменениями в Pug и SCSS
  gulp.watch("src/*.pug", gulp.series("pug"));
  gulp.watch("src/*.scss", gulp.series("scss"));
});

// Таск по умолчанию
gulp.task("default", gulp.series(gulp.parallel("pug", "scss"), "browser-sync"));
