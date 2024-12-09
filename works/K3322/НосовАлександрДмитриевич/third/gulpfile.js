const gulp = require('gulp');
const browserSync = require('browser-sync');

const server = browserSync.create();

gulp.task('serve', () => {
  server.init({
    server: {
      baseDir: './',
      index: 'index.html'
    },
    port: 3000,
    open: true
  });

  gulp.watch('index.html').on('change', server.reload);
});

gulp.task('default', gulp.series('serve'));