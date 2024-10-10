const gulp = require("gulp");
var browserSync = require("browser-sync").create();
const pug = require("gulp-pug");
const sass = require("gulp-sass")(require("sass"));

gulp.task("pug", function () {
  return gulp
    .src("src/*.pug")
    .pipe(pug())
    .pipe(gulp.dest("build/"))
    .pipe(browserSync.stream());
});

gulp.task("scss", function () {
  return gulp
    .src("src/*.scss")
    .pipe(sass())
    .pipe(gulp.dest("build/"))
    .pipe(browserSync.stream());
});

gulp.task("browser-sync", function () {
  browserSync.init({
    server: {
      baseDir: "./build",
    },
  });
  gulp.watch("src/*.pug", gulp.series("pug"));
  gulp.watch("src/*.scss", gulp.series("scss"));
});

gulp.task("default", gulp.series(gulp.parallel("pug", "scss"), "browser-sync"));
