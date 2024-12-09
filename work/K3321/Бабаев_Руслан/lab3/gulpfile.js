const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const { exec } = require('child_process');


// Greeting function
const hello = (cb) => {
    console.log('Hello, from Gulp!');
    cb();
};


// Goodbye function
const goodbye = (cb) => {
    console.log('Goodbye, from Gulp!');
    cb();
};


// Function to start php server and watch for files (with auto-reload)
const phpServer = (done) => {
    const phpServer = exec('php -S localhost:3000 -t ./app');

    phpServer.stdout.on('data', (data) => console.log(data));
    phpServer.stderr.on('data', (data) => console.error(data));

    browserSync.init({
        proxy: 'localhost:3000',
        notify: false,
        startPath: 'feedback.html',
    });

    gulp.watch('./app/*.html').on('change', browserSync.reload);
    gulp.watch('./app/*.php').on('change', browserSync.reload);

    done();
};


exports.series = gulp.series(hello, goodbye);
exports.parallel = gulp.parallel(hello, goodbye); 
exports.serve = gulp.series(phpServer);