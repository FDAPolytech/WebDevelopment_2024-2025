const { parallel } = require('gulp');

function taskA(done) {
  console.log('Task A Completed');
  done();
}

function taskB(done) {
  console.log('Task B Completed');
  done();
}

exports.default = parallel(taskA, taskB);
