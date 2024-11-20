function defaultTask(cb) {
  for (let i = 0; i < 11; i++) {
    console.log(i);
  }
  cb();
}

exports.default = defaultTask;
