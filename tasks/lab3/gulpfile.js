const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function taskOne(done) {
    console.log('Выполняется задача 1');
    done();
}

function taskTwo(done) {
    console.log('Выполняется задача 2');
    done();
}

function html() {
    return gulp.src('src/*.html')
        .pipe(gulp.dest('dist'))
        .pipe(browserSync.stream());
}

function css() {
    return gulp.src('src/css/*.css')
        .pipe(gulp.dest('dist/css'))
        .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        server: {
            baseDir: 'dist'
        }
    });

    gulp.watch('src/*.html', html);
    gulp.watch('src/css/*.css', css);
}

const parallelTasks = gulp.parallel(taskOne, taskTwo);
const seriesTasks = gulp.series(taskOne, taskTwo);

exports.parallel = parallelTasks;
exports.series = seriesTasks;

exports.html = html;
exports.css = css;
exports.serve = serve;

exports.default = seriesTasks;
exports.default = gulp.series(gulp.parallel(html, css), serve);