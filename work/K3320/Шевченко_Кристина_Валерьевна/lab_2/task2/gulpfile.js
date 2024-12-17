const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Задача для запуска локального сервера и слежения за файлами
gulp.task('serve', function () {
    // Настройка локального сервера
    browserSync.init({
        server: {
            baseDir: './', // Папка с вашим проектом
        },
    });

    // Слежение за изменениями HTML и CSS
    gulp.watch('./*.html').on('change', browserSync.reload);
    gulp.watch('./*.css').on('change', browserSync.reload);
});

// Задача по умолчанию
gulp.task('default', gulp.series('serve'));
