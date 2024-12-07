const gulp = require('gulp');
const browserSync = require('browser-sync').create();


gulp.task('serve', function () {
    browserSync.init({
        server: {
            baseDir: "./src/"
        }
    });

    gulp.watch("*.html").on('change', browserSync.reload);
    gulp.watch("*.css").on('change', browserSync.reload);
    gulp.watch("*.js").on('change', browserSync.reload);
});

gulp.task('default', gulp.series('serve'));