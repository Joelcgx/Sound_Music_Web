"use strict";
$(() => {
    checkPassword();
});
function changeForm() {
    const formReg = $("#regForm");
    const formLogin = $("#logForm");
    formReg.toggle();
    formLogin.toggle();
    if (formReg.is(":visible")) {
        $("#switch-title").text("Registrarse");
        $("#switch-p").text("Ya tienes una cuenta?");
        $("#switch-a").text("Inicia sesión");
        $("#title-doc").text("WaveMusic | Registrate");
    }
    if (formLogin.is(":visible")) {
        $("#switch-title").text("Iniciar sesión");
        $("#switch-p").text("No tienes una cuenta?");
        $("#switch-a").text("Registrate");
        $("#title-doc").text("WaveMusic | Iniciar sesión");
    }
}
function checkPassword() {
    const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    const passInput = $("#RegPassword");
    const errorDiv = $("#error");
    passInput.on("input", () => {
        if (regex.test(passInput.val())) {
            errorDiv.hide();
        }
        else {
            errorDiv.text("La contraseña debe tener al menos 8 caracteres, una letra y un numero.");
            errorDiv.show();
            setTimeout(() => {
                errorDiv.hide();
            }, 15000);
        }
    });
}
//# sourceMappingURL=login.js.map