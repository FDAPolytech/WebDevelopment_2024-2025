const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function html() {
    console.log('HTML task started');
    return gulp.src('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.html')
        .pipe(gulp.dest('dist'))
        .on('end', () => console.log('HTML files copied to dist'))
        .pipe(browserSync.stream());
}

function css() {
    console.log('CSS task started');
    return gulp.src('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.css')
        .pipe(gulp.dest('dist'))
        .on('end', () => console.log('CSS files copied to dist'))
        .pipe(browserSync.stream());
}

function js() {
    console.log('JS task started');
    return gulp.src('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.js')
        .pipe(gulp.dest('dist'))
        .on('end', () => console.log('JS files copied to dist'))
        .pipe(browserSync.stream());
}

function serve() {
  browserSync.init({
    server: {
        baseDir: './dist/',
        index: 'example.html',
    },
    notify: false
  });

  gulp.watch('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.html', html);
  gulp.watch('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.css', css);
  gulp.watch('./works/K3323/Бацанова_Екатерина/lab3/ex1/*.js', js);
}

const build = gulp.series(html, css, js);
const watch = gulp.parallel(serve);
const buildParallel = gulp.parallel(html, css, js);

exports.html = html;
exports.css = css;
exports.js = js;
exports.build = build;
exports.watch = watch;
exports.buildParallel = buildParallel;
exports.default = gulp.series(build, watch);
