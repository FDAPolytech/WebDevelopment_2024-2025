const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('copy', () => {
    return gulp.src('src_folder/*.txt')
        .pipe(gulp.dest('dst_folder'));
});


gulp.task('second', (done) => {
    console.log('Second task completed');
    done();
});

gulp.task('sequence', gulp.series('copy', 'second'));
gulp.task('parallel', gulp.parallel('copy', 'second'));

function serve() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });

    gulp.watch("*.html").on('change', browserSync.reload);
    gulp.watch("*.css").on('change', browserSync.reload);
}

gulp.task('default', serve);