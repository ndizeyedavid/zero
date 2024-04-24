console.log(page_route);
if (page_route == "main") {
    task_container = document.querySelector(".task-container");


    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        task_ready=true;
        const res = xhttp.response;
        task_container.innerHTML=res;
        // console.log(res);
    }
    setInterval(()=>{
        xhttp.open("GET", `php/view_task.php?category=${page_route}`);
        xhttp.send();

    }, 1400);
}
