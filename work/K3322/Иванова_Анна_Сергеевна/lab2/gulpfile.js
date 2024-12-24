const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve', () => {
    browserSync.init({
      server: {
        baseDir: './src'
      },
      port: 3000,
      notify: false
    });
  
    gulp.watch('./src/**/*.html').on('change', browserSync.reload);
  });
  
