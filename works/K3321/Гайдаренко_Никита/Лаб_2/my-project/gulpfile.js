function defaultTask(cb) {
    let i = 0;
    while (i < 10) {
        i++;
        console.log(i);
    }
    cb();
  }
  
  exports.default = defaultTask