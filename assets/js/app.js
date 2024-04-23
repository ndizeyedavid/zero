let links = document.querySelectorAll(".link");
let main_container = document.querySelector(".content");
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
function setModal(){
    displayModal();
}

// function addTask(form, event){
    function addTask(task, category, due, desc, form, event){
    if (event.key=="Enter"){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = () =>{
            const res = xhttp.responseText;
            console.log(res);
        }
        xhttp.open("GET", `../../php/add_task.php?task=${task.value}&category=${category.value}&due=${due.value}&desc=${desc.value}`);
        xhttp.send();
        
        form.reset();
    }
}
// function addTask(task, category, due, desc, event){
//     const xhttp = new XMLDocument();
//     xhttp.onload = () =>{
//         const res = xhttp.responseText;
//         console.log(res);
//     }
//     xhttp.open("GET", `../../php/add_task.php?task=${task.value}&category=${category.value}&due=${due.value}&desc=${desc.value}`);
//     xhttp.send();

//     event.preventDefault();
// }