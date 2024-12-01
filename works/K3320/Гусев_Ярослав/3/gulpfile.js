const { src, dest, series, parallel, watch } = require('gulp');
const browserSync = require('browser-sync').create();

async function cleanDist() {
    const { deleteAsync } = await import('del');
    await deleteAsync(['dist/**', '!dist']);
}

function copyHTML() {
    return src('src/**/*.html')
        .pipe(dest('dist/'))
        .pipe(browserSync.stream());
}

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

const build = series(cleanDist, parallel(copyHTML, copyCSS));

exports.cleanDist = cleanDist;
exports.copyHTML = copyHTML;
exports.copyCSS = copyCSS;
exports.build = build;
exports.serve = series(build, serve);
