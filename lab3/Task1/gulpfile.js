const gulp = require('gulp');
const browserSync = require('browser-sync').create();


gulp.task('Привет!', (done) => {
    console.log('Первый ответ получен!');
    done();
});


gulp.task('Пока!', (done) => {
    console.log('Второй ответ получен!');
    done();
});


gulp.task('series', gulp.series('Привет!', 'Пока!'));


gulp.task('parallel', gulp.parallel('Привет!', 'Пока!'));


function serve() {
    browserSync.init({
        server: {
            baseDir: 'C:/Users/123/Desktop/works/К3320/Бахтина Анастасия Вячеславовна/lab3/Task1' 
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
}

gulp.task('default', gulp.series(serve));