
const sayButton = document.getElementById('say');
const input = document.getElementById('inputText');

const say = (text) => {
    console.log(text);
    const input = document.getElementById('inputText').value;
    console.log(input);
    const uttr = new SpeechSynthesisUtterance(input)
    speechSynthesis.speak(uttr)
}
