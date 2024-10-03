// Подключаем Gulp и BrowserSync
const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Функция для динамического импорта модуля `del`
async function clean() {
    const del = (await import('del')).deleteSync;
    console.log('Очистка папки dist...');
    del(['dist/**', '!dist']);
}

// Таск для копирования HTML файлов в папку dist
function copyHtml(done) {
    gulp.src('src/*.html')
        .pipe(gulp.dest('dist'))
        .pipe(browserSync.stream());  // Обновляем браузер
    done();
}

// Таск для копирования CSS файлов
function copyCss(done) {
    gulp.src('src/css/*.css')
        .pipe(gulp.dest('dist/css'))
        .pipe(browserSync.stream());  // Обновляем браузер
    done();
}

// Таск для запуска локального сервера и отслеживания изменений
function serve(done) {
    browserSync.init({
        server: {
            baseDir: './dist'  // Указываем директорию для отображения в браузере
        }
    });

    // Наблюдаем за изменениями в файлах и перезагружаем браузер
    gulp.watch('src/*.html', copyHtml);
    gulp.watch('src/css/*.css', copyCss);
    
    done();
}

// Задачи для последовательного выполнения
gulp.task('build', gulp.series(clean, copyHtml, copyCss));

// Задачи для параллельного выполнения
gulp.task('parallel-build', gulp.parallel(copyHtml, copyCss));

// Задача по умолчанию для запуска проекта с отслеживанием изменений
gulp.task('default', gulp.series('build', serve));