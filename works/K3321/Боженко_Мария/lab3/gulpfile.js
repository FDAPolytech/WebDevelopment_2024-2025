const gulp = require('gulp');

function funcOne(done) {
    console.log('Doing the FIRST function');
    done();
}

function funcTwo(done) {
    console.log('Doing the SECOND function');
    done();
}

const seriesTask = gulp.series(funcOne, funcTwo);

const parallelTask = gulp.parallel(funcOne, funcTwo);

exports.seriesTask = seriesTask;
exports.parallelTask = parallelTask;

// second part

const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

const paths = {
    styles: {
        src: 'src/scss/**/*.scss',
        dest: 'dist/css'
    },
    html: {
        src: 'src/*.html',
        dest: 'dist/'
    }
};

function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
}

function html() {
    return gulp.src(paths.html.src)
        .pipe(gulp.dest(paths.html.dest))
        .pipe(browserSync.stream());
}

function serve() {
    browserSync.init({
        server: {
            baseDir: 'dist'
        }
    });

    gulp.watch(paths.styles.src, styles);
    gulp.watch(paths.html.src, html);
}

exports.styles = styles;
exports.html = html;
exports.serve = serve;

//const def = gulp.series(gulp.parallel(styles, html), serve);

//exports.def = def;

exports.default = gulp.series(gulp.parallel(styles, html), serve)

