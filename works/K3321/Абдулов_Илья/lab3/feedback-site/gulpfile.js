var gulp = require('gulp'),
    connect = require('gulp-connect-php'),
    browserSync = require('browser-sync');

gulp.task('connect', function () {
    connect.server({}, function () {
        browserSync({
            proxy: '127.0.0.1:8000'
        });
    });
});

gulp.task('reload', function () {
    gulp.watch(['*.html', '*.php', '*.css', '*.js']).on('change', function () {
        browserSync.reload();
    });
});

gulp.task('serve', gulp.series('connect', 'reload'));
gulp.task('serve-parallel', gulp.parallel('connect', 'reload'));

gulp.task('default', gulp.series('serve'));
