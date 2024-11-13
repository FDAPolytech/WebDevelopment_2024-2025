const { series, parallel, task, watch } = require("gulp");
const browserSync = require("browser-sync").create();

function runTask1(cb) {
  console.log("Выполнение задачи 1");
  cb();
}

function runTask2(cb) {
  console.log("Выполнение задачи 2");
  cb();
}

task("parallel", parallel(runTask1, runTask2));
task("series", series(runTask1, runTask2));

task("serve", function () {
  browserSync.init({
    server: {
      baseDir: "./src",
    },
  });

  watch("src/*.html").on("change", browserSync.reload);
  watch("src/*.js").on("change", browserSync.reload);
  watch("src/*.css").on("change", browserSync.reload);
});
