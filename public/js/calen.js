const button1 = document.getElementById("select1");
const button2 = document.getElementById("select2");
button1.addEventListener("click", selectButton1);
button2.addEventListener("click", selectButton2);
function selectButton1() {
    const nowSelect = document.getElementById("nowSelect");
    button1.setAttribute("aria-pressed", "true");
    button1.innerText = "トグルボタン：ON";
    button2.setAttribute("aria-pressed", "false");
    button2.innerText = "トグルボタン：OFF";
    nowSelect.innerText = "左";
}
function selectButton2() {
    const nowSelect = document.getElementById("nowSelect");
    button1.setAttribute("aria-pressed", "false");
    button1.innerText = "トグルボタン：OFF";
    button2.setAttribute("aria-pressed", "true");
    button2.innerText = "トグルボタン：ON";
    nowSelect.innerText = "右";
}

