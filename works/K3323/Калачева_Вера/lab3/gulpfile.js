const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const connectPHP = require('gulp-connect-php');

gulp.task('phpServer', function(done) {
    connectPHP.server({
        base: './',
        port: 3000,
        keepalive: true,
        bin: 'C:/Program Files (x86)/php-8.3.13-nts-Win32-vs16-x86/php.exe'
    }, () => console.log('PHP server is running on http://127.0.0.1:3000'));
    done();
});

gulp.task('browserSync', gulp.series('phpServer', function() {
    browserSync.init({
        proxy: '127.0.0.1:3000',
        files: ['*/*.css', '*.html', '*.php'],
        startPath: '/feedback.html'
    });
}));

gulp.task('watch', gulp.series('browserSync', function() {
    gulp.watch(['*.css', '*.html', '*.php']).on('change', browserSync.reload);
}));


// Parallel task
gulp.task('parallel', gulp.parallel(
    function() {
        console.log('First parallel task');
        return new Promise((resolve) => {
            setTimeout(resolve, 1000);
        });
    },
    function() {
        console.log('Second parallel task');
        return new Promise((resolve) => {
            setTimeout(resolve, 2000);
        });
    }
));

// Sequence task
gulp.task('sequence', gulp.series(
    function() {
        console.log('First sequential task');
        return new Promise((resolve) => {
            setTimeout(resolve, 1000);
        });
    },
    function() {
        console.log('Second sequential task');
        return new Promise((resolve) => {
            setTimeout(resolve, 2000);
        });
    }
));

gulp.task('default', gulp.series('watch'));
