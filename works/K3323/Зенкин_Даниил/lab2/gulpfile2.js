const gulp = require('gulp');

gulp.task('show-pages', async function () {
    const open = (await import('open')).default;

    const pages = [
        'https://www.google.com',
        'https://www.github.com',
        'https://webref.ru',
        'https://forums.space.com'
    ];

    const interval = 5000;

    for (const page of pages) {
        console.log(`Открываю страницу: ${page}`);
        await open(page);
        await new Promise((resolve) => setTimeout(resolve, interval));
    }
    console.log('Все страницы показаны.');
});
