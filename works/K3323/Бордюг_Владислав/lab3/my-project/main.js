document.addEventListener("DOMContentLoaded", function() {
    const button = document.getElementById('action-button');
    const message = document.getElementById('message');

    button.addEventListener('click', function() {
        message.textContent = "You clicked the button! Magic happened!";
        button.textContent = "Clicked!";
        button.style.backgroundColor = '#28a745';
    });
});
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

const paths = {
    styles: {
        src: './*.scss',
        dest: './'
    },
    scripts: {
        src: './*.js',
        dest: './'
    }
};

function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
}

function scripts() {
    return gulp.src(paths.scripts.src)
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(browserSync.stream());
}

function watch() {
    browserSync.init({
        server: {
            baseDir: './'
        }
    });
    gulp.watch(paths.styles.src, styles);
    gulp.watch(paths.scripts.src, scripts);
    gulp.watch('./*.html').on('change', browserSync.reload);
}

gulp.task('build-sequential', gulp.series(styles, scripts));

gulp.task('build-parallel', gulp.parallel(styles, scripts));

gulp.task('default', watch);