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