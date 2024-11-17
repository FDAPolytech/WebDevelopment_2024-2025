const gulp = require('gulp');
const {series, parallel} = require('gulp');
const browserSync = require('browser-sync').create();

function serve() {
    browserSync.init({
        server: {
            baseDir: 'C:/Users/igors/VSCodeProjects/webLabs/lab3/task1' 
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
    gulp.watch('css/*.css').on('change', browserSync.reload);
    gulp.watch('js/*.js').on('change', browserSync.reload);
}

function hello(cb) {
    
    console.log("hello!");
    cb();
}

function bye(cb) {
    
    console.log('bye bye');
    cb();
}

exports.serve = serve;
exports.default = serve;


exports.ser = series(hello, bye);
exports.par = parallel(hello, bye);