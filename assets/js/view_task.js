if (page_route == "main" || page_route == "important" || page_route == "planned" || page_route == "assigned" || page_route == "completed") {
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
