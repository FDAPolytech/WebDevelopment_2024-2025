const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function task1(done) {
    console.log('a');
    done();
}
function task2(done) {
    console.log('b');
    done();
}

function watchFiles() {
    browserSync.init({
        server: {
            baseDir: "./src"
        }
    });

    gulp.watch("./src/*.html").on('change', browserSync.reload);
    gulp.watch("./src/*.css").on('change', browserSync.reload);
}

exports.series = gulp.series(task1, task2);
exports.parallel = gulp.parallel(task1, task2);
exports.watch = watchFiles;
