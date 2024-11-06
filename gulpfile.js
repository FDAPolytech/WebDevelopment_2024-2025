const gulp = require('gulp');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

const paths = {
    html: './works/K3321/Горлов_Игорь/lab3/*.html',
    js: './works/K3321/Горлов_Игорь/lab3/scripts/*.js',
    css: './works/K3321/Горлов_Игорь/lab3/*.css'
};

function concatJs () {
    return gulp.src(paths.js)
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./works/K3321/Горлов_Игорь/lab3'))
        .pipe(browserSync.stream()); // Автоматическое обновление JS
}

function watchFile () {
    browserSync.init({
        server: {
            baseDir: './works/K3321/Горлов_Игорь/lab3/', // Корень сервера для отображения
        }
    });
    gulp.watch(paths.js, concatJs);
    gulp.watch(paths.html).on('change', browserSync.reload);
    gulp.watch(paths.css).on('change', browserSync.reload);
}

const sequentialTask = gulp.series(watchFile, concatJs); // Последовательное выполнение
const parallelTask = gulp.parallel(watchFile, concatJs); // Параллельное выполнение

exports.sequential = sequentialTask;
exports.parallel = parallelTask;
