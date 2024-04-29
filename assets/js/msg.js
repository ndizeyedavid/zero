var emoji_btn = document.querySelector('#emoji');
var message_inp = document.querySelector('#message');
var send_btn = document.querySelector('#send-btn');
var msg_container = document.querySelector('.message-holder');

document.querySelector('#send-msg-form').onsubmit = (e) =>{
    e.preventDefault();
    send_btn.click();
}

send_btn.onclick = () =>{
    if (message_inp.value != ""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = () =>{
            const res = xhttp.response;
            if (res == "yeah"){
                message_inp.value='';
                scrollBottom();
            }else{
               Toastify({
                    text: "Message not sent",
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "red",
                    }
                }).showToast(); 
            }
        }
        xhttp.open("GET", `php/insert_message.php?msg=${message_inp.value}&team=${team}`);
        xhttp.send();
    }else{
        Toastify({
            text: "Trying to send an empty message",
            className: "info",
            gravity: "top",
            position: "center",
            style: {
                background: "red",
            }
        }).showToast();
    }
}

emoji_btn.onclick = () =>{
    alert("coming soon");
}

// message fetching
var fetching = setInterval(function(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = () =>{
        const res = xhttp.response;
        msg_container.innerHTML = res;
    }
    xhttp.open("GET", `php/fetch_messages.php?id=${team}`);
    xhttp.send();
},1000);

function scrollBottom(){
    msg_container.scrollTop = msg_container.scrollHeight;
}