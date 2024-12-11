const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function task1(done) {
    console.log('Первый таск');
    done();
}
function task2(done) {
    console.log('Второй таск');
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

// Последовательное выполнение задач
const series = gulp.series(task1, task2);

// Параллельное выполнение задач
const parallel = gulp.parallel(task1, task2);

exports.series = series;
exports.parallel = parallel;
exports.watch = watchFiles;