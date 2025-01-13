const gulp = require('gulp');
const browserSync = require('browser-sync').create();

function serve(done) {
    browserSync.init({
        server: {
            baseDir: '/Users/anastasiakucak/my-project' 
        }
    });
    done();
}

function reload(done) {
    browserSync.reload();
    done();
}

function watchFiles() {
    gulp.watch('./*.html', reload); 
    gulp.watch('./css/*.css', reload); 
    gulp.watch('./js/*.js', reload); 
}

const dev = gulp.series(serve, watchFiles);

exports.default = dev;
