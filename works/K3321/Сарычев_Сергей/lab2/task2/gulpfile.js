const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const cleanCSS = require('gulp-clean-css')
const browserSync = require('browser-sync').create()

gulp.task('styles', function () {
  return gulp
    .src('src/style.css')
    .pipe(cleanCSS())
    .pipe(gulp.dest('dist'))
    .pipe(browserSync.stream())
})

gulp.task('scripts', function () {
  return gulp
    .src('src/app.js')
    .pipe(uglify())
    .pipe(gulp.dest('dist'))
    .pipe(browserSync.stream())
})

gulp.task('html', function () {
  return gulp
    .src('src/index.html')
    .pipe(gulp.dest('dist'))
    .pipe(browserSync.stream())
})

gulp.task('watch', function () {
  browserSync.init({
    server: {
      baseDir: './dist',
    },
  })
  gulp.watch('src/style.css', gulp.series('styles'))
  gulp.watch('src/app.js', gulp.series('scripts'))
  gulp.watch('src/index.html', gulp.series('html'))
})

gulp.task('default', gulp.series('styles', 'scripts', 'html', 'watch'))
