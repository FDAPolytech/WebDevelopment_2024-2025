const gulp = require('gulp');

const webPages = [
  'https://example.com',
  'https://ya.ru',
  'https://browsersync.io'
];

const interval = 5000;

async function showWebPages(done) {
  let index = 0;
  const open = (await import('open')).default;

  function openPage() {
    if (index < webPages.length) {
      console.log(`Opening: ${webPages[index]}`);
      open(webPages[index]);
      index++;
      setTimeout(openPage, interval);
    } else {
      done();
    }
  }

  openPage();
}

exports.default = gulp.series(showWebPages);