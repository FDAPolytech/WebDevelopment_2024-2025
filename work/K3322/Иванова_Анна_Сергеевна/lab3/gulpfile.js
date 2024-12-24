const gulp = require("gulp");
const concat = require('gulp-concat');
const browserSync = require('browser-sync');

const paths = {
    html: {
        src: 'page/*.html',
        dest: 'dist/'
    },
    js: {
        src: 'page/*.js',
        dest: 'dist/'
    }
    
};


gulp.task('concat_js',function(){
    return gulp.src(paths.js.src)
    .pipe(concat('all.js'))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());

});

gulp.task('move_html',function(){
    return gulp.src(paths.html.src)
    .pipe(gulp.dest(paths.html.dest))
    .pipe(browserSync.stream());;

});


gulp.task('show', function() {
    browserSync.init({
        server: {
            baseDir: './dist' 
        }
    });
    
    gulp.watch(paths.js.src, gulp.series('concat_js')); 
    gulp.watch(paths.html.src, gulp.series('move_html')); 
     
    
});


gulp.task('build', gulp.series('concat_js', 'move_html'));
gulp.task('parallel', gulp.parallel('concat_js', 'move_html'));
gulp.task('present', gulp.series('build', 'show'));

