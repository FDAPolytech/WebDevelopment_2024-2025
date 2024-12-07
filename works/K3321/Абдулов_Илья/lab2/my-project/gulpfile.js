const { watch, src, dest, series } = require('gulp');
const uglify = require('gulp-uglify');

function minifyJS() {
    return src('src/*.js')
        .pipe(uglify())
        .pipe(dest('dist'));
}

function watchFiles() {
    watch('src/*.js', { ignoreInitial: false }, series(minifyJS));
}

exports.default = watchFiles;
