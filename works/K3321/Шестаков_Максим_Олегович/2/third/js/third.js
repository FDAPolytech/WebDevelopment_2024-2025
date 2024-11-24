let pages;

fetch('pages.json')
  .then(response => response.json())
  .then(data => {
    pages = data;
    changePage();
  });

function changePage() {
  const frame = document.getElementById('frame');
  let pageIdx = 0;
  function showPage() {
    frame.src = pages[pageIdx].url;
    setTimeout(() => {
      pageIdx = (pageIdx + 1) % pages.length;
      showPage();
    }, pages[pageIdx].interval);
  }
  showPage();
}