const gulp = require('gulp');
const {series, parallel} = require('gulp');
const browserSync = require('browser-sync').create();

function serve() {
    browserSync.init({
        server: {
            baseDir: 'D:/WEB/Лаба_3' 
        }
    });

    gulp.watch('*.html').on('change', browserSync.reload);
}

function Natasha(cb) {
    
    console.log("I invite you to my house!");
    cb();
}

function Dacha(cb) {
    
    console.log('Welcome to my Dacha!');
    cb();
}

exports.serve = serve;
exports.default = serve;


exports.ser = series(Natasha,Dacha);
exports.par = parallel(Dacha,Natasha);