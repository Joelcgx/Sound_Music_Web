export function ShowUI(url) {
    const div = $(".errorMsgLogin");
    const h1 = div.find("h1");
    const p = div.find("p");
    switch (url) {
        case "sessionExpired":
            div.toggle();
            h1.text("Sesión expirada");
            p.text("La sesión ha expirado. Por favor, inicia sesión de nuevo.");
            clearUrl(div);
            break;
        case "userNotFound":
            div.toggle();
            h1.text("Usuario no encontrado");
            p.text("El usuario no se encuentra registrado. Por favor, registrese.");
            clearUrl(div);
            break;
        case "passwordIncorrect":
            div.toggle();
            h1.text("Contraseña incorrecta");
            p.text("La contraseña no coincide. Por favor, introduzca la contraseña correcta.");
            clearUrl(div);
            break;
        case "23000":
            div.toggle();
            h1.text("Usuario ya registrado");
            p.text("El usuario ya se encuentra registrado. Por favor, inicia sesión.");
            clearUrl(div);
            break;
        default:
            div.toggle();
            h1.text("Error");
            p.text("Error no controlado pongase en contacto con el administrador");
            clearUrl(div);
            break;
    }
}
function clearUrl(div) {
    setTimeout(() => {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete("error");
        const cleanParams = urlParams.toString();
        const cleanUrl = cleanParams
            ? `${window.location.pathname}?${cleanParams}`
            : window.location.pathname;
        console.log(cleanUrl);
        window.history.replaceState(null, "", cleanUrl);
        div.toggle();
    }, 15000);
}
//# sourceMappingURL=UI.js.map