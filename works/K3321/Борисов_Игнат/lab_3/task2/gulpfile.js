const gulp = require('gulp');
const phpConnect = require('gulp-connect-php');
const browserSync = require('browser-sync').create();

gulp.task('php', function() {
    phpConnect.server({ base: '.', port: 8000, keepalive: true });
});

gulp.task('serve', function() {
    browserSync.init({
        proxy: '127.0.0.1:8000',
        open: true,
        notify: false
    });

    gulp.watch(['*.html', '*.php']).on('change', browserSync.reload);
});

gulp.task('default', gulp.parallel('php', 'serve'));
