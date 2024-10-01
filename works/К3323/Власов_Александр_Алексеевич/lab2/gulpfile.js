import gulp from 'gulp';
import imagemin, { gifsicle, mozjpeg, optipng, svgo } from 'gulp-imagemin';

// Таск для оптимизации изображений
function images() {
    return gulp.src('images/*.png')
        .pipe(imagemin([
            optipng({ optimizationLevel: 5 })
        ]))
        .pipe(gulp.dest('dst'));
}

export default gulp.series(images)
