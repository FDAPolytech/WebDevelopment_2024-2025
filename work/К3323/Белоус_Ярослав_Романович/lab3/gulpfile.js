const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync').create();

const paths = {
    html: {
        src: 'src/*.html',
        dest: 'dist/'
    },
    css: {
        src: 'src/css/*.css',
        dest: 'dist/css/'
    }
};

function copyHTML() {
    return gulp.src(paths.html.src)
        .pipe(gulp.dest(paths.html.dest))
        .pipe(browserSync.stream());
}

function minifyCSS() {
    return gulp.src(paths.css.src)
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(gulp.dest(paths.css.dest))
        .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        server: {
            baseDir: './dist'
        }
    });

    gulp.watch(paths.html.src, copyHTML);
    gulp.watch(paths.css.src, minifyCSS);
}

// Последовательное выполнение
const build = gulp.series(copyHTML, minifyCSS);

// Параллельное выполнение
const parallelTasks = gulp.parallel(copyHTML, minifyCSS);

exports.build = build;
exports.parallel = parallelTasks;
exports.serve = serve;
