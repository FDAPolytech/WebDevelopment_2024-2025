const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve', function() {
    browserSync.init({
        server: {
            baseDir: './works/K3323/Бацанова_Екатерина/lab2'
        }
    });
gulp.watch('./works/K3323/Бацанова_Екатерина/lab2/*.html').on('change', browserSync.reload);
gulp.watch ('./works/K3323/Бацанова_Екатерина/Lab2/*.css').on('change', browserSync.reload) ;
gulp.watch('./works/K3323/Бацанова_Екатерина/lab2/*.js').on('change', browserSync.reload);
});