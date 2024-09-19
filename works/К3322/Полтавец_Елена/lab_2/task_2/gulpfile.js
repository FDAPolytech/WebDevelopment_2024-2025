var gulp        = require('gulp'), // подключаем Gulp
	sass        = require('gulp-sass')(require('sass')), // подключаем Sass пакет,
	browserSync = require('browser-sync'); // подключаем Browser Sync
 
gulp.task('sass', async function(){ // создаем таск Sass
	return gulp.src('app/sass/**/*.sass') // берем источник
		.pipe(sass({ indentedSyntax: true }).on('error', sass.logError)) // преобразуем Sass в CSS посредством gulp-sass
		.pipe(gulp.dest('app/css')) // выгружаем результата в папку app/css
		.pipe(browserSync.reload({stream: true})) // обновляем CSS на странице при изменении
});
 
gulp.task('browser-sync', async function() { // создаем таск browser-sync
	browserSync({ // выполняем browserSync
		server: { // определяем параметры сервера
			baseDir: 'app' // директория для сервера - app
		},
		notify: false // отключаем уведомления
	});
});
 
gulp.task('code', async function() {
	return gulp.src('app/*.html')
	.pipe(browserSync.reload({ stream: true }))
});
 
gulp.task('watch', async function() {
	gulp.watch('app/sass/**/*.sass', gulp.parallel('sass')); // наблюдение за sass файлами
	gulp.watch('app/*.html', gulp.parallel('code')); // наблюдение за HTML файлами в корне проекта
});
gulp.task('default', gulp.parallel('sass', 'browser-sync', 'watch'));

	