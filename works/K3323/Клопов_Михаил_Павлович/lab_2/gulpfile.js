var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
function defaultTask(cb) 
{
  browserSync.init({
        server: {
            baseDir: "./"
        }
    });
}

exports.default = defaultTask


// Static server
gulp.task('browser-sync', function() 
{
    
});

