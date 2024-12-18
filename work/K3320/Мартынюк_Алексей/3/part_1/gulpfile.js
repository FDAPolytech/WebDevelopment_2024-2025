import gulp from 'gulp';
import open from 'open';
import browserSync from 'browser-sync';

const browser = browserSync.create();

function getArgs() {
    const args = process.argv.slice(2);
    const urls = [];
    let interval = 5000; 

    args.forEach(arg => {
        if (arg.startsWith('--url=')) {
            urls.push(arg.split('=')[1]);
        } else if (arg.startsWith('--interval=')) {
            interval = parseInt(arg.split('=')[1], 10);
        }
    });

    return { urls, interval };
}

function openUrl(url) {
    return function(done) {
        console.log(`Opening URL: ${url}`);
        open(url, { app: { name: 'chromium' } }).catch(err => {
            console.error(`Failed to open URL: ${url}`, err);
        });
        done();
    };
}

gulp.task('open-urls-sequential', function(done) {
    const { urls, interval } = getArgs();

    if (urls.length === 0) {
        console.error("No URLs provided. Use --url=<url1> --url=<url2> ...");
        return done();
    }

    const tasks = urls.map((url, index) => {
        return function(cb) {
            setTimeout(() => {
                openUrl(url)(cb);
            }, index * interval);
        };
    });

    gulp.series(...tasks)(done);
});

gulp.task('open-urls-parallel', function(done) {
    const { urls } = getArgs();

    if (urls.length === 0) {
        console.error("No URLs provided. Use --url=<url1> --url=<url2> ...");
        return done();
    }

    const tasks = urls.map(url => openUrl(url));
    gulp.parallel(...tasks)(done);
});

gulp.task('serve', function() {
    browser.init({
        server: {
            baseDir: './' 
        }
    });

    gulp.watch('./*.html').on('change', browser.reload);
    gulp.watch('./css/*.css').on('change', browser.reload);
});

gulp.task('default', gulp.series('open-urls-sequential', 'open-urls-parallel', 'serve'));
