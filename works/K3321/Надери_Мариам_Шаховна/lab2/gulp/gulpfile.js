
var gulp = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('simpleTask', async function () {
	console.log('Hi! This is my firts simple task =)');
});

gulp.task('webSlider', function () { 
	browserSync.init({ 
		server: { 
			baseDir: 'app' 
		}
	});

	gulp.watch('app/index.html').on('change', browserSync.reload);
});

