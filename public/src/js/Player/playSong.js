"use strict";
/**
 * La función "reproducir" realiza una solicitud AJAX a un servidor para reproducir una canción y
 * actualiza el reproductor con información y progreso de la canción.
 * @param {string} path - El parámetro `ruta` en la función `reproducir` es una cadena que representa
 * la ruta al archivo de canción que desea reproducir. Esta ruta se utiliza para recuperar información
 * sobre la canción e iniciar la reproducción de la canción utilizando un elemento de audio HTML.
 */
function play(path) {
    const player = document.getElementById("player-audio");
    $.ajax({
        url: "/private/src/server/php/handler/handler.php",
        dataType: "json",
        type: "GET",
        async: true,
        data: {
            function: "PlaySong",
            song: path,
        },
        success: (response) => {
            const { Album, Artist, AudioSource, Cover, Genre, Title } = response;
            const data = [Album, Artist, AudioSource, Cover, Genre, Title];
            playerInit(player, data);
            player.oncanplay = () => {
                player.ontimeupdate = () => updateProgress(player);
                player.play();
            };
            // Play Count
            setTimeout(() => {
                $.ajax({
                    url: "http://192.168.100.168:8080/playCount",
                    dataType: "json",
                    data: {
                        title: data[5],
                        artist: data[1],
                        album: data[0],
                        count: 1,
                    },
                    success: (res) => {
                        console.log(res);
                    },
                    error: (jqxhr, txt) => {
                        console.log([jqxhr, txt]);
                    },
                });
            }, 0);
        },
        error: (jqhxr, txt) => {
            console.log([jqhxr, txt]);
        },
    });
}
/**
 * La función `playerInit` inicializa un reproductor con elementos de audio y UI utilizando los datos
 * proporcionados.
 * @param {HTMLAudioElement} player - El parámetro `player` es un elemento de audio HTML que se
 * utilizará para reproducir el archivo de audio.
 * @param {string[]} data - El parámetro "datos" es una matriz que contiene información sobre una pista
 * de música. Aquí está el desglose de los elementos de la matriz:
 */
function playerInit(player, data) {
    // UI const
    const cover = $("#player-cover");
    const title = $("#player-title");
    const artist = $("#player-artist");
    // Set info to UI
    cover.attr("src", `data:image/webp;base64,${data[3]}`);
    title.text(data[5]);
    artist.text(data[1]);
    player.src = `data:audio/mp3;base64,${data[2]}`;
}
/**
 * La función `updateProgress` actualiza la barra de progreso de un reproductor de audio HTML según el
 * tiempo de reproducción actual.
 * @param {HTMLAudioElement} player - HTMLAudioElement: representa un elemento de audio en el documento
 * HTML, normalmente utilizado para reproducir archivos de audio.
 */
function updateProgress(player) {
    const progressBar = $(".progress-bar");
    const duration = player.duration;
    const currentTime = player.currentTime;
    if (progressBar) {
        progressBar.css("width", `${(currentTime / duration) * 100}%`);
        $("#player-currentTime").text(formatTime(currentTime));
        $("#player-duration").text(formatTime(duration));
    }
}
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    const formattedTime = `${minutes
        .toString()
        .padStart(2, "0")}:${remainingSeconds.toString().padStart(2, "0")}`;
    return formattedTime;
}
//# sourceMappingURL=playSong.js.map