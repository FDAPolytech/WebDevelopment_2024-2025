const { watch } = require('gulp');
const browserSync = require("browser-sync").create();

function autoreloadPage(){
    browserSync.init({
        server:{
            baseDir: "./"
        }
    })

    watch("index.html").on("change", browserSync.reload);
}

exports.autoreloadPage = autoreloadPage;

//gulp --gulpfile gulpfile1b.js autoreloadPage