const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('sum', (done) => {
  const a = 1;
  const b = a + 5;
  console.log(b + a);
  done();
});

gulp.task('dif', (done) => {
  const a = 8;
  const b = 5;
  console.log(a - b);
  done();
});

gulp.task('seriesTasks', gulp.series('sum', 'dif'));
gulp.task('parallelTasks', gulp.parallel('sum', 'dif'));

const paths = {
  html: 'src/index.html',
  css: 'src/css/style.css',
  js: 'src/js/script.js'
};

gulp.task('serve', () => {
  browserSync.init({
    server: {
      baseDir: 'src'
    }
  });

  gulp.watch(paths.html).on('change', browserSync.reload);
  gulp.watch(paths.css).on('change', browserSync.reload);
  gulp.watch(paths.js).on('change', browserSync.reload);
});

gulp.task('WEB', gulp.series('serve'));



