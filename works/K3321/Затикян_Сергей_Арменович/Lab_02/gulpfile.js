const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve', function() {
    // Инициализация сервера
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });

    // Следить за изменениями в HTML-файлах
    gulp.watch("index.html").on('change', browserSync.reload);
});
