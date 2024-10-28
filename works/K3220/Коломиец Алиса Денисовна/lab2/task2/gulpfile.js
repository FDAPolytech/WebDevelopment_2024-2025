var gulp = require("gulp");
var browserSync = require("browser-sync").create();

gulp.task("serve", function () {
  browserSync.init({
    server: {
      baseDir: "./src",
    },
  });

  gulp.watch("src/*.html").on("change", browserSync.reload);
  gulp.watch("src/*.js").on("change", browserSync.reload);
});
