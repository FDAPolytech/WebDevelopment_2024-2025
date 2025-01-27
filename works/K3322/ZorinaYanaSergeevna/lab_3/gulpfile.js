const gulp = require("gulp");

function taskOne(cb) {
    console.log("Task 1 is started");
    setTimeout(() => {
        console.log("Task 1 is finished");
        cb();
    }, 2000);
}

function taskTwo(cb) {
    console.log("Task 2 is started");
    setTimeout(() => {
        console.log("Task 2 is finished");
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