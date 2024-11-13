const div = document.createElement("div");
div.innerHTML = "КЛИКНИТЕ СЮДА И ПОЛУЧИТЕ ПРИЗ!";

const handleClick = () => alert("АААА КНОПКА ТЫКНУТА");
div.onclick = handleClick;

document.body.append(div);
