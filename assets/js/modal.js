let modal = document.getElementById("modal-box");
let span = document.getElementsByClassName("close")[0];

// inside modals
let desc_modal = document.querySelector(".desc-cont");
let voice_modal = document.querySelector(".ai_voice");
let team_modal = document.querySelector(".new_team");
function displayModal(option) {
  modal.style.display = "block";
  if (option == "description") {
    desc_modal.style.display="";
  }else{
    desc_modal.style.display="none";
  }

  if (option == "voice") {
    voice_modal.style.display="";
  }else{
    voice_modal.style.display="none";
  }

  if (option == "new_team") {
    team_modal.style.display="";
  }else{
    team_modal.style.display="none";
  }
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}