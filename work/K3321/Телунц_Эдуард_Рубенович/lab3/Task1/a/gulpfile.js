const { series, parallel } = require('gulp');

function firstTask (done){
    console.log("Первое задание");
    done();
};

function secondTask(done){
    console.log('Вторая задание');
    done();
}

exports.parallel = parallel(firstTask, secondTask)
exports.series = series(firstTask, secondTask)