const gulp = require('gulp');
const browserSync = require("browser-sync").create();

function watchFiles() {
    browserSync.init({
        server: {
            baseDir: "./dist",
        },
    });

    gulp.watch("./src/css/**/*.css", copyCss)
    gulp.watch("./src/*.html", copyHtml)
    gulp.watch("./src/**/*.html", copyHtml).on('change', browserSync.reload); 
}

function copyHtml() {
    return gulp.src("./src/index.html")
        .pipe(gulp.dest("./dist"))
        .pipe(browserSync.stream());
}

function copyCss() {
    return gulp.src(["./src/css/*.css"])
        .pipe(gulp.dest("dist/css"))
        .pipe(browserSync.stream());
}


const buildSequence = gulp.series(copyCss, copyHtml);
const parallelTask = gulp.parallel(buildSequence, watchFiles);

exports.default = gulp.task('default', buildSequence);
exports.watch = watchFiles;
exports.parallel = parallelTask;
