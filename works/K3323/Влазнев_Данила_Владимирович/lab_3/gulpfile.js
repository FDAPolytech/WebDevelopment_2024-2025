const gulp = require('gulp');
const cleanCss = require('gulp-clean-css');
const browserSync = require('browser-sync').create();

function styles() {
    return gulp.src('./src/**/*.css')
      .pipe(cleanCss())
      .pipe(gulp.dest('./dist/css'))
      .pipe(browserSync.stream());
}

function html() {
    return gulp.src('./src/**/*.html')
        .pipe(gulp.dest('./dist/html'))
        .pipe(browserSync.stream());
}

function php() {
  return gulp.src('./src/**/*.php')
      .pipe(gulp.dest('./dist/php'))
      .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        server: {
            baseDir: './dist'
        }
    });

    gulp.watch('./src/**/*.css', styles);
    gulp.watch('./src/**/*.html', html);
    gulp.watch('./src/**/*.php', php);
    gulp.watch('./src/**/*.html').on('change', browserSync.reload);
}

const build = gulp.series(html, styles, php);

const dev = gulp.parallel(serve, build);

gulp.task('build', build);
gulp.task('dev', dev);