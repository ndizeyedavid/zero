// reserved variables 🎮🎮
let task_container;
// ***********************
let due = "";
let description = "";
let links = document.querySelectorAll(".link");
let main_container = document.querySelector(".content");
let calendar_container = document.querySelector("#calendar");
let right_panel = document.getElementById('right-container');
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
