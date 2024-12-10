const { watch } = require('gulp');
const browserSync = require("browser-sync").create();
const connectPHP = require("gulp-connect-php");

function autoreloadPage(){
    connectPHP.server({}, function(){
        browserSync.init({
            proxy: "127.0.0.1:8000"
        });
    
    });

    watch("index.html").on("change", browserSync.reload);
    watch("formHandler.php").on("change", browserSync.reload);
}

exports.autoreloadPage = autoreloadPage;

//gulp --gulpfile gulpfile2.js autoreloadPage