const gulp = require("gulp");
const browserSync = require("browser-sync").create();

gulp.task("serve", function () {
  browserSync.init({
    server: {
      baseDir: "./lab1",
    },
    port: 3000,
  });

  gulp.watch("./lab1/*.html").on("change", browserSync.reload);
  gulp.watch("./lab1/css/**/*.css").on("change", browserSync.reload);
  gulp.watch("./lab1/js/**/*.js").on("change", browserSync.reload);
});

gulp.task("default", gulp.series("serve"));
