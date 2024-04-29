if (page_route == "main" || page_route == "important" || page_route == "planned"  || page_route == "completed") {
    task_container = document.querySelector(".task-container");
    // console.log(page_route);


    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        task_ready=true;
        const res = xhttp.response;
        task_container.innerHTML=res;
        // console.log(res);
    }
    lp = setInterval(()=>{
        xhttp.open("GET", `php/view_task.php?type=${page_route}`);
        xhttp.send();

    }, 1000);
}
if (page_route=="team"){
    document.querySelector('.record-btn-call').style.display="none";
}else{
    document.querySelector('.record-btn-call').style.display="block";
}

// notification fetching
if (page_route == "notification"){
    document.querySelector('.record-btn-call').style.display="none";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        document.querySelector('.notif-container').innerHTML = res;
    }
    xhttp.open("GET", `php/fetch_notification.php`);
    xhttp.send();
}
// update theme
themes = document.querySelectorAll(".color");
themes.forEach((theme)=>{
    theme.onclick = () =>{
        themes.forEach(theme=>{
            theme.classList.remove('active');
        });
        
        theme.classList.add('active');
        main_cont.style.background = theme.style.background;

    };
});

if (page_route == "main"){
    date_cont = document.querySelector(".date");
    date_cont.textContent = date;
}


// more task adding

// task by button
function addTask2(){
    var task = document.querySelector('#task');
    var category = document.querySelector('#category');
    var desc = document.querySelector('#task_desc');
    var form = document.querySelector('#form-cont');

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
