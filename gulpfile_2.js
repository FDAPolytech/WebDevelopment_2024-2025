const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const phpConnect = require('gulp-connect-php');

// Задача для запуска PHP-сервера и `browser-sync`
gulp.task('serve', function () {
    // Запускаем PHP-сервер с корневой папкой
    phpConnect.server({
        base: 'works/K3321/Горлов_Игорь/lab3/', // Корень сервера
        port: 8000, // Порт
        keepalive: true // Запускать PHP-сервер в фоновом режиме
    }, function () {
        // После запуска PHP-сервера инициализируем `browser-sync`
        browserSync.init({
            proxy: '127.0.0.1:8000', // Адрес PHP-сервера
            notify: false // Отключить уведомления
        });
    });

    // Наблюдение за изменениями файлов для автоматического обновления
    gulp.watch("works/K3321/Горлов_Игорь/lab3/*.html").on('change', browserSync.reload);
    gulp.watch("works/K3321/Горлов_Игорь/lab3/*.php").on('change', browserSync.reload);
    gulp.watch("works/K3321/Горлов_Игорь/lab3/*.css").on('change', browserSync.reload);
    gulp.watch("works/K3321/Горлов_Игорь/lab3/*.js").on('change', browserSync.reload);
});

// Команда по умолчанию
gulp.task('default', gulp.series('serve'));
