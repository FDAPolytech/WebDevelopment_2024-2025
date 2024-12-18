// var gulp = require('gulp');
// const browserSync = require('browser-sync').create();
//
// gulp.task('Hello', function(done){
//     console.log("Hello, world!");
//     done();
// });
// gulp.task('GoodBye', function(done){
//     console.log("GoodBye, world!");
//     done();
// });
//
// gulp.task('order', gulp.series('Hello', 'GoodBye'));
// gulp.task('parallel', gulp.parallel('Hello', 'GoodBye'));

let project_folder = "dist";
let source_folder = "src";

let path = {
    build: {
        html: project_folder + "/",
        css: project_folder + "/css/",
        js: project_folder + "/js/",
        img: project_folder + "/img/"
    },
    src: {
        html: [source_folder + "/*.html", "!" + source_folder + "/_*.html"],
        css: source_folder + "/scss/style.scss",
        js: source_folder + "/js/script.js",
        img: source_folder + "/img/**/*.{jpg, png, svg, gif, ico, webp}"
    },
    watch: {
        html: source_folder + "/**/*.html",
        css: source_folder + "/scss/**/*.scss",
        js: source_folder + "/js/**/*.js",
        img: source_folder + "/img/**/*.{jpg, png, svg, gif, ico, webp}"
    },
    clean: "./" + project_folder + '/'

}

let {src, dest} = require('gulp'),
    gulp = require('gulp'),
    browsersync =  require("browser-sync").create(),
    fileinclude = require("gulp-file-include");

function browserSync(params){
    browsersync.init({
        server:{
            baseDir: "./" + project_folder + '/'
        },
        port:3000,
        notify:false
    })
}
function html() {
    return src(path.src.html)
        .pipe(fileinclude())
        .pipe(dest(path.build.html))
        .pipe(browsersync.stream())
}

function watchFiles(params){
    gulp.watch([path.watch.html], html);
}

let build = gulp.series(html);
let watch = gulp.parallel(build, watchFiles, browserSync);

exports.html = html;
exports.build = build;
exports.watch = watch;
exports.default = watch;