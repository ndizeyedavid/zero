// reserved variables 🎮🎮
let task_container, themes, message, lp, date_cont, team_id, team, prompt;
// ***********************
let due = "";
let description = "";
let links = document.querySelectorAll(".link");
let main_container = document.querySelector(".content");
let calendar_container = document.querySelector("#calendar");
let right_panel = document.getElementById('right-container');
let main_cont = document.getElementById('main-container'); 
let run_btn = document.querySelector('.run');
let user_msg = document.querySelector('#out');
links.forEach((link)=>{
    link.onclick = () =>{
        links.forEach(link=>{
            link.classList.remove('active');
        });
        
        link.classList.add('active');
        loadPage(link);
    };
});

// input functionality

// modals integration
function setModal(option){
    displayModal(option);
}

// calendar visibility
let isVis = false;
function calendar(){
    if (!isVis){
        calendar_container.style.display="";
        isVis=true;
    }else{
        calendar_container.style.display="none";
        isVis=false;
    }
}


// function addTask(form, event){
function addTask(task, category, desc, form, event){
    if (event.key=="Enter"){
        if(task.value != ""){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = () =>{
                const res = xhttp.responseText;
                Toastify({
                text: res,
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    color: "black",
                    background: "lime",
                }
                }).showToast();
            }
            xhttp.open("GET", `php/add_task.php?task=${task.value}&category=${category.value}&due=${due}&desc=${desc.value}&tab=${page_route}`);
            xhttp.send();
            
            form.reset();
            document.getElementById("task_desc").value="";
        }else{
            Toastify({
            text: "Enter a task first",
            className: "info",
            gravity: "top",
            position: "center",            
            style: {
                background: "red",
            }
            }).showToast();
        }
    }
}


// taskComplete
function taskComplete(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        if (res == "yes") {
            Toastify({
                text: "Task Completion updated",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    color: "black",
                    background: "lime",
                }
            }).showToast();            
        }else{
            Toastify({
                text: "An error occured",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast();            
        }
    }
    xhttp.open("GET", `php/complete_task.php?id=${id}`);
    xhttp.send();
}

// Add to important
function modeChange(id){
const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        if (res == "yes"){
            Toastify({
                text: "Task priority updated",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    color: "black",
                    background: "lime",
                }
            }).showToast(); 
        }else{
            Toastify({
                text: "An error occured",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast(); 
        }
    }
    xhttp.open("GET", `php/important_task.php?id=${id}`);
    xhttp.send();    
}

// displaying right side panel
function displayDetails(id){
    right_panel.style.display="";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        right_panel.innerHTML = res;
    }
    xhttp.open("GET", `php/task_details.php?id=${id}`);
    xhttp.send();

}

// updating the task details
function updateTask(id){
    var task = document.querySelector('#inp-task');
    var category = document.querySelector('#inp-category');
    var due = document.querySelector('#inp-due');
    var desc = document.querySelector('#inp-desc');
    if (task.value == "") {
        Toastify({
            text: "Enter the task first",
            className: "info",
            gravity: "top",
            position: "center",
            style: {
                background: "red",
            }
        }).showToast();        
    }else{
        // updating
        const xhttp = new XMLHttpRequest();
        xhttp.onload = () =>{
            const res = xhttp.response;
            console.log(res);
            if (res == "yes"){
                Toastify({
                    text: "Task updated",
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        color: "black",
                        background: "lime",
                    }
                }).showToast();
            }else{
                Toastify({
                    text: "An error occured",
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "red",
                    }
                }).showToast();
            }
        }
        xhttp.open("GET", `php/update_task.php?task=${task.value}&category=${category.value}&due=${due.value}&desc=${desc.value}&id=${id}`);
        xhttp.send();
        document.querySelector('.bi-x-lg').click();
    }
}

// Deleting a task
function deleteTask(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        if (res == "yes"){
            Toastify({
                text: "Task Deleted",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    color: "black",
                    background: "lime",
                }
            }).showToast();
        }else{
            Toastify({
                text: "An error occured",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast();
        }
    }
    xhttp.open("GET", `php/delete_task.php?id=${id}`);
    xhttp.send();
    document.querySelector('.bi-x-lg').click();
}
// closing right panel
function closePanel(){
    document.getElementById("right-container").style.display='none';
}

// theme menu
let isOpen = false;
function showMenu(theme_cont){
    if (!isOpen){
        theme_cont.style.display="";
        isOpen = true;
    }else{
        theme_cont.style.display="none";
        isOpen = false;
    }
}

const keyWords = {
  command: [
    { word: "create", action: "add" },
    { word: "add", action: "add" },
    { word: "plan", action: "add" },
]
};
run_btn.onclick = () =>{
    var isThere = false;
    message = user_msg.innerHTML.toLocaleLowerCase();
    // console.log(message);
    // if
    for (let i = 0; i < keyWords.command.length; i++){
        if (message.includes(keyWords.command[i].word)){
            isThere = true;
            message = message.split(keyWords.command[i].word);
            message = message[1];
            prompt = keyWords.command[i].action;
        }
    }

    if (isThere){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = () =>{
            const res = xhttp.response;
            if (res != "err"){
                Toastify({
                    text: res,
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "linear-gradient(45deg, #23afc9, #9856b7)",
                    }
                }).showToast(); 
            }else{
                Toastify({
                    text: "Ai encountered error",
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "red",
                    }
                }).showToast(); 
            }
        }
        xhttp.open("GET", `php/ai.php?q=${message}&prompt=${prompt}`);
        xhttp.send();
        modal.style.display = "none";
    }else{
        console.log("nah");
    }
    // console.log(keyWords.command[0].word);
    // message pre-processing
}

// upload img
function uploadImg() {
    document.getElementById("upload-inp").click();
    document.getElementById("upload-inp").addEventListener("change", function(event){
        var file = event.target.files[0];
        var type = file.type.split('/');
        type = type[0];
        if (type != "image") {
            Toastify({
                text: "Wrong Image format",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast();
            return false;
        }
    
        var reader = new FileReader();
    
        reader.onload = function(event) {
            var src = event.target.result;
            document.getElementById('imagePreview').src = src;
        }
        
        reader.readAsDataURL(file);
    });
    document.getElementById("upload-inp").value = "";
}

// team Menu pop-up
let menuOpen = false;
function teamMenu(menu_options) {
    if (!menuOpen) {
        menu_options.style.display = "";
        menuOpen = true;
    }else{
        menu_options.style.display = "none";
        menuOpen = false;
    }
}

// fetching members
function fetchMembers(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        console.log(id);
        document.querySelector('.members-here').innerHTML=res;
    }
    xhttp.open("GET", `php/fetch_members.php?id=${id}`);
    xhttp.send();
}

// sending invite
function sendInvite(email){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        email.value = '';
        const res = xhttp.response;
        if (res == "yes"){
            Toastify({
                text: "Invited Sent successfully",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    color: "black",
                    background: "lime",
                }
            }).showToast();
        }else{
            Toastify({
                text: "Invalid E-mail address",
                className: "info",
                gravity: "top",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast();
        }
    }
    xhttp.open('GET', `php/send_invite.php?email=${email.value}&team_id=${team_id}`);
    xhttp.send();
    modal.style.display = "none";
}

// message container
function fetchMessages(team_id, container){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        container.innerHTML = res;

        var script = document.createElement('script');
        script.src = 'assets/js/msg.js';
        document.body.appendChild(script); 
        team = team_id;
    }
    xhttp.open("GET", `php/msg_container.php?id=${team_id}`);
    xhttp.send();
}