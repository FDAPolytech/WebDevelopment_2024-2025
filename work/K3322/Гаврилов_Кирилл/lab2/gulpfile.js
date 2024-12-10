// const gulp = require('gulp')

// const fileinclude = require('gulp-file-include');

// gulp.task("hello", function(callback){
//     console.log("Hello, world!");
//     callback();
// });

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
    // del = require("del");

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

// function clean(params){
//     return del(path.clean);
// }
let build = gulp.series(html);
let watch = gulp.parallel(build, watchFiles, browserSync);

exports.html = html;
exports.build = build;
exports.watch = watch;
exports.default = watch;