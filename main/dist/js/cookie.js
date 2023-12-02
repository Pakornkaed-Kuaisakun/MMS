function setCookie(name, value, exdays) {
    const d = new Date();
    d.setTime(d.setTime + (exdays*24*60*60*1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}