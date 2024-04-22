// let page_route = "main";
const loadPage = (link) =>{
    page_route = link.href;
    page_route = page_route.split("#");
    page_route = page_route[1];
    console.log(page_route);
 
    
    handleLocation();
}

const routes = {
    "404": "../pages/404.html",
    "": "../pages/main.html",
    "main": "../pages/main.html",
    "important": "../pages/important.html",
    "assigned": "../pages/assigned.html",
    "planned": "../pages/planned.html",
    "task": "../pages/task.html",
    "team": "../pages/team.html",
    "notification": "../pages/notification.html",
};


const handleLocation = async () => {
    const route = routes[page_route];
    const html = await fetch(route).then((data) => data.text());
    main_container.innerHTML = html;
};

const defaultLocation = () =>{
    let page_route = window;
    console.log(page_route);
    // page_route = page_route.split("#");
    // page_route = page_route[1];
}

// handleLocation()