const gulp = require("gulp");

function copyJs() {
  return gulp.src("src/*.pug").pipe(gulp.dest("dist"));
}

function copyCss() {
  return gulp.src("src/*.scss").pipe(gulp.dest("dist"));
}

exports.default = gulp.series(copyJs, copyCss);
