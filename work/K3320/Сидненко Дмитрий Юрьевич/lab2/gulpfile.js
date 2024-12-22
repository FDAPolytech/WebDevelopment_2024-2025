import gulp from 'gulp'; 
import browserSync from 'browser-sync'; 

//Простой таск
gulp.task('hello', function(done) {
    console.log('Привет, это моя первая задача в Gulp!');
    done(); 
});




//Таск с отслеживанием обновлений
gulp.task('serve', function() {
    browserSync.init({
        server: {
            baseDir: './'  
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
    gulp.watch('css/*.css').on('change', browserSync.reload);
    gulp.watch('js/*.js').on('change', browserSync.reload);
});





//Таск который открывает сайты

const open = (await import('open')).default;

// Список URL-ов, которые мы хотим показывать
const urls = [
    'https://www.futbin.com/',
    'https://www.kinopoisk.ru/',
    'https://my.itmo.ru/'
];


const intervalTime = 5000;

let currentPageIndex = 0;

gulp.task('serve1', function() {

    browserSync.init({
        server: './', 

    });

    // Функция для открытия страниц с интервалом
    setInterval(function() {
        if (currentPageIndex >= urls.length) {
            currentPageIndex = 0; // Если страницы закончились, начать сначала
        }
        open(urls[currentPageIndex]);
        currentPageIndex++;
    }, intervalTime); 
});

gulp.task('default', gulp.series('serve'));
