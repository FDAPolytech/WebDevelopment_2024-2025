const div = document.createElement("div");
div.innerHTML = "12345 вышел зайчик погулять";

const handleClick = () => alert("АААА КНОПКУ ТЫКНУЛИ СПАСИТЕ");
div.onclick = handleClick;

document.body.append(div);
