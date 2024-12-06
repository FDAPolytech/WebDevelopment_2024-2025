import gulp from 'gulp';
import open from 'open'


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

gulp.task('open-urls', function(done) {
    const { urls, interval } = getArgs();

    if (urls.length === 0) {
        console.error("No URLs provided. Use --url=<url1> --url=<url2> ...");
        return done();
    }

    let index = 0;

    const openNextUrl = () => {
        if (index >= urls.length) {
            return;
        }

        console.log(`Opening URL: ${urls[index]}`);
        open(urls[index], { app: { name: 'chromium' } }).catch(err => {
            console.error(`Failed to open URL: ${urls[index]}`, err);
        });
        index += 1;
        setTimeout(openNextUrl, interval);
    };

    openNextUrl();
    done();
});

gulp.task('default', gulp.series('open-urls'));