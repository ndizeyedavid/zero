// reserved variables 🎮🎮
let task_container, themes, message;
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
        const xhttp = new XMLHttpRequest();
        xhttp.onload = () =>{
            const res = xhttp.responseText;
            console.log(res);
        }
        xhttp.open("GET", `php/add_task.php?task=${task.value}&category=${category.value}&due=${due}&desc=${desc.value}`);
        xhttp.send();
        
        form.reset();
        document.getElementById("task_desc").value="";
    }
}


// taskComplete
function taskComplete(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        alert("Task completed!");
    }
    xhttp.open("GET", `php/complete_task.php?id=${id}`);
    xhttp.send();
}

// Add to important
function modeChange(id){
const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        console.log(res);
        // alert("Added to important!");
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
],
  due: [
    { word: "due", action: "date" },
    { word: "end", action: "date" },
  ],
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
        }
    }

    if (isThere){
        console.log(message);
        document.getElementById('task').value=message;
        modal.style.display="none";
    }else{
        console.log("nah");
    }
    // console.log(keyWords.command[0].word);
    // message pre-processing
}