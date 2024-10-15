const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const open = require('gulp-open');
const readline = require('readline');

// Greeting task
const hello = (cb) => {
  console.log('Hello, from Gulp!');
  cb();
};

// Task to start BrowserSync and watch for changes in HTML files
const serve = () => {
  browserSync.init({ server: './track' });
  gulp.watch('./track/*.html').on('change', browserSync.reload);
};

// Function to open a page using gulp-open
const openPage = (url) => gulp.src(__filename).pipe(open({ uri: url }));

// Function to create a console input interface
const askQuestion = (query) => new Promise((resolve) => {
  const rl = readline.createInterface({ input: process.stdin, output: process.stdout });
  rl.question(query, (answer) => {
    rl.close();
    resolve(answer);
  });
});

// Asynchronous function to open pages with a delay
const openPagesWithDelay = async () => {
  const urlInput = await askQuestion('Enter a list of URLs, separated by spaces:\n');
  const urls = urlInput.split(/\s+/).map(url => url.trim());

  const delayInput = await askQuestion('Enter the delay in seconds:\n');
  const delay = parseInt(delayInput, 10) * 1000;

  for (const url of urls) {
    await openPage(url);
    console.log(`Page ${url} opened. Waiting for ${delay} milliseconds...`);
    await new Promise(resolve => setTimeout(resolve, delay));
  }
};

// Export tasks
exports.default = hello;
exports.hello = hello;
exports.serve = serve;
exports.pages = openPagesWithDelay;
