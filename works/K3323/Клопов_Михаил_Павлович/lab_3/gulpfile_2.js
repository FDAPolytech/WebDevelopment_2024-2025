const gulp = require('gulp');
gulp.task('one', (done) => {
    console.log('Action 1');
    done();
   }); 
   
   gulp.task('two', (done) => {
    console.log('Action 2');
    done();
   }); 
function defaultTask(cb) 
{
  cb();
}   
gulp.task('default', gulp.series('one', 'two', gulp.parallel('one', 'two')));

