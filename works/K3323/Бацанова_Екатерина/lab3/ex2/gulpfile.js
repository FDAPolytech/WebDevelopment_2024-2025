const gulp = require("gulp");
const browserSync = require("browser-sync").create();
const phpConnect = require("gulp-connect-php");

const paths = {
  html: "./feedback_form.html",
  php: "./process_feedback.php",
  css: "./style.css",
};

gulp.task("php", function (done) {
  phpConnect.server({ base: "./", port: 8000, keepalive: true }, function () {
    done();
  });
});

gulp.task("serve", gulp.series("php", function () {
  browserSync.init({
    proxy: "http://localhost:8000/feedback_form.html",
    index: "feedback_form.html",
    notify: false,
    open: "false",
  });

  gulp.watch(paths.html).on("change", browserSync.reload);
  gulp.watch(paths.php).on("change", browserSync.reload);
  gulp.watch(paths.css).on("change", browserSync.reload);
}));

gulp.task("default", gulp.series("serve"));
