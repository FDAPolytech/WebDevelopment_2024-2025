const { src, dest, series, parallel, watch } = require('gulp');
const browserSync = require('browser-sync').create();

// Таск для очистки директории
async function cleanDist() {
  const deleteAsync = await import('del');
  await deleteAsync.deleteAsync(['dist/**', '!dist']);
}

// Таск для копирования HTML файлов
function copyHTML() {
  return src('src/**/*.html')
    .pipe(dest('dist/'))
    .pipe(browserSync.stream());
}

// Таск для копирования CSS файлов
function copyCSS() {
  return src('src/styles/**/*.css')
    .pipe(dest('dist/styles/'))
    .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        server: {
            baseDir: "dist/"
        }
    });
    watch('src/**/*.html', copyHTML);
    watch('src/styles/**/*.css', copyCSS);
}

const buildParallel = series(cleanDist, parallel(copyHTML, copyCSS));

const buildSeries = series(cleanDist, series(copyHTML, copyCSS));

// Экспортируем таски
exports.cleanDist = cleanDist;
exports.copyHTML = copyHTML;
exports.copyCSS = copyCSS;
exports.buildParallel = buildParallel;
exports.buildSeries = buildSeries;
exports.serve = series(buildParallel, serve);
