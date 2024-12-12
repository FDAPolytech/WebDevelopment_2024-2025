
var gulp = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('simpleTask', async function () {
	console.log('Hi! This is my firts simple task =)');
});

gulp.task('simpleTask2', async function () {
	console.log("I'm second task! Good morning everybody +)");
});


gulp.task('notParallel', gulp.series('simpleTask', 'simpleTask2'))
gulp.task('Parallel', gulp.parallel('simpleTask', 'simpleTask2'))


gulp.task('update_index', function () {
	return gulp.src('app/index.html').pipe(browserSync.stream());
});
gulp.task('update_style', function () {
	return gulp.src('app/style.css').pipe(browserSync.stream());
});
gulp.task('update_main', function () {
	return gulp.src('app/main.js').pipe(browserSync.stream());
});
gulp.task('webSlider', function () {
	browserSync.init({
		server: {
			baseDir: 'app'
		}
	});
	gulp.watch('app/index.html').on('change', browserSync.reload);
	gulp.watch('app/main.js').on('change', browserSync.reload);
	gulp.watch('app/style.css').on('change', browserSync.reload);
});
gulp.task('auto-update', gulp.parallel('update_main', 'update_style', 'update_index', 'webSlider'));


