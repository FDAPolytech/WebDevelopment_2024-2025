const gulp = require('gulp');
   const browserSync = require('browser-sync').create();

   gulp.task('serve', function() {
       browserSync.init({
           server: {
               baseDir: "./src"
           }
       });

       gulp.watch("src/*.html").on('change', browserSync.reload);
       gulp.watch("src/*.js").on('change', browserSync.reload);
       gulp.watch("src/*.css").on('change', browserSync.reload);
   });

   gulp.task('default', gulp.series('serve'));
