const gulp = require('gulp');

function funcOne(done) {
    console.log('Doing the FIRST function');
    done();
}

function funcTwo(done) {
    console.log('Doing the SECOND function');
    done();
}

const seriesTask = gulp.series(funcOne, funcTwo);

const parallelTask = gulp.parallel(funcOne, funcTwo);

exports.seriesTask = seriesTask;
exports.parallelTask = parallelTask;
