const gulp = require('gulp');

// ������
function task1(done) {
    console.log("Task 1 ��������");
    done();
}

function task2(done) {
    console.log("Task 2 ��������");
    done();
}

// ���������������� ����������
const sequential = gulp.series(task1, task2);

// ������������ ����������
const parallel = gulp.parallel(task1, task2);

const browserSync = require('browser-sync').create();
const { watch, series } = gulp;

// ������ �������
function serve(done) {
    browserSync.init({
        server: {
            baseDir: "./" // ���� � ������ �������
        }
    });
    done();
}

// �������������� ��������
function reload(done) {
    browserSync.reload();
    done();
}

// ���������� �� �������
function watchFiles() {
    watch("*.html", reload);
    watch("css/*.css", reload);
    watch("js/*.js", reload);
}

// ������
exports.default = series(serve, watchFiles);


