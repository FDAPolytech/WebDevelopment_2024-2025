// function defaultTask(cb) {

//     cb();
// }

// exports.defaul = defaultTask;

var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
});