const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

// Функция для "засыпания"
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Задача для компиляции SASS в CSS
gulp.task('styles', async function() {
    await sleep(3000); // заснуть на 3 секунды
    return gulp.src('scss/**/*.scss')  // Путь к SASS файлам
        .pipe(sass().on('error', sass.logError))  // Компиляция SASS в CSS
        .pipe(gulp.dest('css'))  // Путь для сохранения скомпилированного CSS
        .pipe(browserSync.stream());  // Автоматическая перезагрузка браузера
});

// Задача для автоматической перезагрузки
gulp.task('serve', async function() {
    browserSync.init({
        server: {
            baseDir: './'  // Путь к вашей папке проекта
        }
    });
    await sleep(3000); // заснуть на 3 секунды
    // Слежение за изменениями в SASS файлах
    gulp.watch('scss/**/*.scss', gulp.series('styles')); 
    // Слежение за изменениями в HTML файлах
    gulp.watch('./*.html').on('change', browserSync.reload);
});

gulp.task('add-text', function(done) {
    console.log('Добавляем текст в HTML...');

    const fs = require('fs');
    const path = 'index.html';

    // Читаем файл
    fs.readFile(path, 'utf8', (err, data) => {
        if (err) {
            console.error('Ошибка чтения файла:', err);
            return;
        }

        // Добавляем текст перед закрывающим тегом </body>
        const textToAdd = '<p>Хорошего дня и приятного вечера!</p>';
        const result = data.replace('</body>', `${textToAdd}</body>`);

        // Записываем результат в тот же файл
        fs.writeFile(path, result, 'utf8', (err) => {
            if (err) {
                console.error('Ошибка записи файла:', err);
                return;
            }
            console.log('Текст успешно добавлен в конец тела HTML.');
            done();
        });
    });
});

// Параллельное выполнение задач
gulp.task('parallel-tasks', gulp.parallel('styles', 'serve', 'add-text'));

// Основная задача - последовательное выполнение и автоматическая перезагрузка
gulp.task('default', gulp.series('styles', 'serve', 'add-text'));
