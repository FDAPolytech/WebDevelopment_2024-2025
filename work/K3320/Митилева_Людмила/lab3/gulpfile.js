//var gulp = require('gulp');

//gulp.task('task1', function(callback) {
//    console.log('Task 1');
//    callback();
//})
//gulp.task('task2', function (callback) {
//    console.log('Task 2');
//    callback();
//})

//gulp.task('default', gulp.parallel('task1', 'task2'));



const gulp = require("gulp")
const browserSync = require("browser-sync").create();

gulp.task("browserSync", function () {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
    gulp.watch("*.html").on("change", browserSync.reload);
});

gulp.task("default", gulp.series("browserSync"));
