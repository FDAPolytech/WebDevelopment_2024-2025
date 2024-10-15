var gulp = require("gulp");
var browserSync = require("browser-sync").create();

// const { src, dest } = require("gulp");
// const babel = require("gulp-babel");
// exports.default = function () {
//   return src("src/*.js")
//     .pipe(babel({ presets: ["@babel/env"] }))
//     .pipe(dest("build/"));
// };

gulp.task("serve", function () {
  browserSync.init({
    server: {
      baseDir: "./src",
    },
  });

  gulp.watch("src/*.html").on("change", browserSync.reload);
  gulp.watch("src/*.js").on("change", browserSync.reload);
});
