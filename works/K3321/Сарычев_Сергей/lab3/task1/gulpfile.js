const gulp = require('gulp')
const browserSync = require('browser-sync').create()

// Пути к файлам
const paths = {
  html: 'src/**/*.html',
  css: 'src/styles/**/*.css',
  js: 'src/scripts/**/*.js',
}

// Таск для работы с HTML
function htmlTask() {
  console.log('задача 1')
  return gulp.src(paths.html).pipe(gulp.dest('dist')).pipe(browserSync.stream())
}

// Таск для работы с CSS
function cssTask() {
  console.log('задача2')
  return gulp
    .src(paths.css)
    .pipe(gulp.dest('dist/styles'))
    .pipe(browserSync.stream())
}

// Таск для работы с JS
function jsTask() {
  console.log('задача3')
  return gulp
    .src(paths.js)
    .pipe(gulp.dest('dist/scripts'))
    .pipe(browserSync.stream())
}

// Таск для запуска сервера и автообновления
function serve() {
  browserSync.init({
    server: {
      baseDir: 'dist',
    },
  })

  gulp.watch(paths.html, htmlTask)
  gulp.watch(paths.css, cssTask)
  gulp.watch(paths.js, jsTask)
}

// Последовательное выполнение тасков
const buildSequential = gulp.series(htmlTask, cssTask, jsTask)

// Параллельное выполнение тасков
const buildParallel = gulp.parallel(htmlTask, cssTask, jsTask)

// Экспортируем таски
exports.default = gulp.series(buildParallel, serve)
exports.buildSequential = buildSequential
exports.buildParallel = buildParallel
exports.serve = serve
