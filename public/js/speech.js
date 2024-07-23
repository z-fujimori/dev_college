
// const sayButton = document.getElementById('say');
const input = document.getElementById('inputText');


const say = async (text) => {
    console.log(text);
    console.log(speechSynthesis.getVoices());
    const input = document.getElementById('inputText').value;
    console.log(input);
    const uttr = new SpeechSynthesisUtterance(text)
    const vType = speechSynthesis.getVoices().filter(voice => voice.name == 'Hattori')[0] //Google 日本語, O-Ren, Kyoko
    uttr.voice = vType;
    speechSynthesis.speak(uttr)
}
