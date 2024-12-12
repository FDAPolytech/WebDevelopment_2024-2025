const gulp = require("gulp");

function taskOne(cb) {
  console.log("Задача 1 стартовала");
  setTimeout(() => {
    console.log("Задача 1 завершена");
    cb();
  }, 2000);
}

function taskTwo(cb) {
  console.log("Задача 2 стартовала");
  setTimeout(() => {
    console.log("Задача 2 завершена");
    cb();
  }, 1000);
}

exports.sequential = gulp.series(taskOne, taskTwo);

exports.parallel = gulp.parallel(taskOne, taskTwo);

const browserSync = require("browser-sync").create();
function serve(cb) {
  browserSync.init({
    server: {
      baseDir: "./",
    },
  });
  cb();
}

function watchFiles(cb) {
  gulp.watch("*.html").on("change", browserSync.reload);
  gulp.watch("css/*.css").on("change", browserSync.reload);
  gulp.watch("js/*.js").on("change", browserSync.reload);
  cb();
}

exports.serve = gulp.series(serve, watchFiles);
