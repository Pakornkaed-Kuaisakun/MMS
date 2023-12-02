const online = document.getElementById("isOnlinePage"),
    offline = document.getElementById("isOfflinePage"),
    reload_timer = document.getElementById("reload-timer");

let isOnline = true, interValId, timer = 10;

const checkConnection = async () => {
    try {
        const response = await fetch("https://jsonplaceholder.typicode.com/posts");
        isOnline = response.status >= 200 && response.status < 300;
    } catch(error) {
        isOnline = false;
        console.log(error);
    }
    timer = 10;
    clearInterval(interValId);
    handlePopup(isOnline);

}

const handlePopup = (status) => {
    if(status) {
        online.style.display = "";
        offline.style.display = "none";
        document.body.style.pointerEvents = "all";
    } else {
        online.style.display = "none";
        offline.style.display = "flex"; 
        document.body.style.pointerEvents = "none";
    }

    interValId = setInterval(() => {
        if(timer === 0) checkConnection();
        reload_timer.innerText = "Reload in " + timer + " seconds";
        timer--;
    }, 1000);
}

setInterval(() => isOnline && checkConnection(), 3000); 