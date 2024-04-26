click_to_record.addEventListener("click", function () {
  // document.getElementById('out').innerHTML = "";
  var speech = true;
  window.SpeechRecognition = window.webkitSpeechRecognition;

  const recognition = new SpeechRecognition();
  recognition.interimResults = true;

  recognition.addEventListener("result", (e) => {
    const transcript = Array.from(e.results)
      .map((result) => result[0])
      .map((result) => result.transcript)
      .join("");

    document.getElementById("out").innerHTML = transcript;
    console.log(transcript);
  });

  if (speech == true) {
    recognition.start();
  }
});
