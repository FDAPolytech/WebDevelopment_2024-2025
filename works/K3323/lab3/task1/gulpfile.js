const { series, parallel, task, watch } = require("gulp");
const browserSync = require("browser-sync").create();
function runTask1(done) {
  console.log("Запуск задачи 1");
  done();
}
function runTask2(done) {
  console.log("Запуск задачи 2");
  done();
}
task("parallelTasks", parallel(runTask1, runTask2));
task("seriesTasks", series(runTask1, runTask2));
task("browser-sync", function () {
  browserSync.init({
    server: {
      baseDir: "./src",
    },
  });
  watch("src/*.html").on("change", browserSync.reload);
  watch("src/*.js").on("change", browserSync.reload);
  watch("src/*.css").on("change", browserSync.reload);
});
