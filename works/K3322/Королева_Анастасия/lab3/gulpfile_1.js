const { series } = require('gulp');

function taskOne(done) {
  console.log('Task One Completed');
  done();
}

function taskTwo(done) {
  console.log('Task Two Completed');
  done();
}

exports.default = series(taskOne, taskTwo);
