const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Задача для последовательного выполнения
gulp.task('task1', (done) => {
    console.log('Task 1 выполнен!');
    done();
});

gulp.task('task2', (done) => {
    console.log('Task 2 выполнен!');
    done();
});

// Последовательное выполнение
gulp.task('sequence', gulp.series('task1', 'task2'));

// Параллельное выполнение
gulp.task('parallel', gulp.parallel('task1', 'task2'));

// Настройка BrowserSync для отображения в браузере
gulp.task('browser-sync', (done) => {
    browserSync.init({
        server: {
            baseDir: './', // Укажите папку проекта
        },
        notify: false,
    });
    done();
});

// Следим за изменениями файлов
gulp.task('watch', () => {
    gulp.watch('./*.html').on('change', browserSync.reload);
    gulp.watch('./*.css').on('change', browserSync.reload);
    gulp.watch('./*.js').on('change', browserSync.reload);
});

// Главная задача
gulp.task('default', gulp.series('browser-sync', 'watch'));
