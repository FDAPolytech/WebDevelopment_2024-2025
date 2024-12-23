const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass')(require('sass'));

// Задача для компиляции SCSS в CSS
function styles() {
  return gulp.src('src/scss/**/*.scss')  // Путь к SCSS файлам
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('dist/css'))
    .pipe(browserSync.stream());
}

// Задача для объединения и минификации JS файлов
function scripts() {
  return gulp.src('src/js/**/*.js')  // Путь к JS файлам
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('dist/js'))
    .pipe(browserSync.stream());
}

// Задача для автоматического перезапуска браузера при изменении файлов
function serve() {
  browserSync.init({
    server: {
      baseDir: './'  // Папка для сервера
    }
  });

  gulp.watch('src/scss/**/*.scss', styles);
  gulp.watch('src/js/**/*.js', scripts);
  gulp.watch('*.html').on('change', browserSync.reload);
}

// Задача для последовательного выполнения
const buildSequence = gulp.series(styles, scripts);

// Задача для параллельного выполнения
const buildParallel = gulp.parallel(styles, scripts);

// Экспортируем задачи
exports.styles = styles;
exports.scripts = scripts;
exports.serve = serve;
exports.buildSequence = buildSequence;
exports.buildParallel = buildParallel;
exports.default = gulp.series(buildSequence, serve);
