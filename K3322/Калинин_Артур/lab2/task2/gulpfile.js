const {src, dest} = require('gulp');
const scss = require('gulp-sass')(require('sass'));

function styles(){
    return src('app/scss/style.scss')
    .pipe(scss({outputStyle: 'compressed'}))
    .pipe(dest('app/css'))
}

exports.styles = styles;