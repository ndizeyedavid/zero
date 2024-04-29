let modal = document.getElementById("modal-box");
let span = document.getElementsByClassName("close")[0];

// inside modals
let desc_modal = document.querySelector(".desc-cont");
let voice_modal = document.querySelector(".ai_voice");
let team_modal = document.querySelector(".new_team");
let members = document.querySelector(".members");
let invite = document.querySelector(".invite");
let join_team = document.querySelector(".join_team");

function displayModal(option, id) {
  document.querySelector('.modal-content').style.width="30%";
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

  if (option == "members") {
    document.querySelector('.modal-content').style.width="80%";
    members.style.display="";
    fetchMembers(id);
  }else{
    members.style.display="none";
  }

  if (option == "invite") {
    invite.style.display="";
    team_id = id;
  }else{
    invite.style.display="none";
  }

  if (option == "join_team") {
    join_team.style.display="";
  }else{
    join_team.style.display="none";
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