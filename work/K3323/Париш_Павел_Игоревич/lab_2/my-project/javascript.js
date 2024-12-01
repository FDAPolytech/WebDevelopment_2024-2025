let links = [
	"https://www.wikipedia.org",
	"https://www.example.com"
];

let cur = 0;

let playInterval;

function updateIframe() {
	const frame = document.getElementById('frame');
	frame.src = links[cur];
}

function updateLinkList() {
	const linkList = document.getElementById('Links');
	linkList.innerHTML = "";
	links.forEach((link,index) => {
		const li = document.createElement('li');
		li.className = 'lis';
		li.textContent = link;
		const removeButton = document.createElement('button');
		removeButton.className = 'removebutton';
		removeButton.textContent = "Remove";
		removeButton.onclick = () => {
			removeLink(index);
		};
		li.appendChild(removeButton);
		linkList.appendChild(li);
	});
}

function addLink() {
	const newLink = document.getElementById('newLink').value;
	if (newLink) {
		links.push(newLink);
		document.getElementById('newLink').value = "";
		updateLinkList();
	}
}

function removeLink(index) {
	if (links.length > 1) {
		links.splice(index, 1);
		updateLinkList();
	}
}

function prevPage() {
	cur = (cur-1+links.length)%links.length;
	updateIframe();
}

function nextPage() {
	cur = (cur+1)%links.length;
	updateIframe();
}

function startAuto() {
	const interval = document.getElementById('numInterval').value * 1000;
	playInterval = setInterval(() => {
		nextPage();
	}, interval);
}

function stopAuto() {
	clearInterval(playInterval);
}

document.addEventListener('DOMContentLoaded', () => {
    updateIframe();
    updateLinkList();
});