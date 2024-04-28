let page_route = "main";
const loadPage = (link) =>{
    page_route = link.href;
    page_route = page_route.split("#");
    page_route = page_route[1];
    // console.log(page_route);
 
    
    handleLocation();
}

const routes = {
    "404": "pages/404.html",
    "": "pages/main.html",
    "main": "pages/main.html",
    "important": "pages/important.html",
    "assigned": "pages/assigned.html",
    "planned": "pages/planned.html",
    "completed": "pages/completed.html",
    "team": "pages/team.php",
    "notification": "pages/notification.html",
};


const defaultLocation = () =>{
    page_route = window.location.href;
    page_route = page_route.split("#");
    page_route = page_route[1];
    if (page_route === undefined){
        page_route = "main";
    }
    document.getElementById(page_route).classList.add("active");
    // console.log(page_route);
    handleLocation();
}

const handleLocation = () => {

    const route = routes[page_route];
    const xhttp_n = new XMLHttpRequest(); 
    xhttp_n.onload = () =>{
        const res = xhttp_n.response;
        main_container.innerHTML = res;

        var script = document.createElement('script');
        script.src = 'assets/js/view_task.js';
        document.body.appendChild(script);
    }
    xhttp_n.open("GET", route);
    xhttp_n.send();
};