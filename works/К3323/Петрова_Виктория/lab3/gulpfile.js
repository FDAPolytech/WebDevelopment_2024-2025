const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const connectPHP = require('gulp-connect-php');

// Пример первого таска
gulp.task('task1', (done) => {
    console.log('Task 1 выполнен!');
    done();
});

// Пример второго таска
gulp.task('task2', (done) => {
    console.log('Task 2 выполнен!');
    done();
});

// Последовательное выполнение
gulp.task('sequence', gulp.series('task1', 'task2'));

// Параллельное выполнение
gulp.task('parallel', gulp.parallel('task1', 'task2'));

gulp.task('phpServer', function(done) {
    connectPHP.server({
        base: './',
        port: 3000,
        keepalive: true,
        bin: 'D:/рамус/php/php.exe'
    }, () => console.log('PHP server is running on http://127.0.0.1:3000'));
    done();
});

gulp.task('browserSync', gulp.series('phpServer', function() {
    browserSync.init({
        proxy: '127.0.0.1:3000',
        files: ['*/*.css', '*/*.html', '*.php'],
        startPath: '/feedback.html'
    });
}));

gulp.task('watch', gulp.series('browserSync', function() {
    gulp.watch(['*/*.css', '*/*.html']).on('change', browserSync.reload);
}));


gulp.task('default', gulp.series('watch'));