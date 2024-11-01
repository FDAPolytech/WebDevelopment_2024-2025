const gulp = require('gulp');

gulp.task('hello', () => {
  console.log('hello, Gulp');
});





// function styles(){
//   return src('style.scss')
//     .pipe(sass({outputStyle: 'compressed'}))
//     .pipe(dest('css'));
// }

// exports.styles = styles



const {src, dest} = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function styles(){
  return src('style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(dest('css'));
}

exports.styles = styles