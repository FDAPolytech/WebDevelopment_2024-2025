const { series, parallel } = require('gulp');

function firstTask (done){
    console.log("Первая таска");
    done();
};

function secondTask(done){
    console.log('Вторая таска');
    done();
}

exports.parallel = parallel(firstTask, secondTask)
exports.series = series(firstTask, secondTask)

