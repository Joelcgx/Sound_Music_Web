var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { get_songs, handle_artist, handle_artist_image, handle_cover, handle_most_played, handle_songs_async, } from "../request/get.js";
$(() => {
    IndexSongsMain();
    // Set Timeout for 1.5 seconds
    setTimeout(() => {
        index_artists();
    }, 1500);
    setTimeout(() => {
        mostPlayed();
    }, 1000);
    setTimeout(() => {
        listeners_init();
    }, 100);
});
/**
 * La función `IndexSongsMain` recupera datos de canciones, las clasifica aleatoriamente y crea
 * dinámicamente tarjetas de gráficos en la interfaz de usuario para mostrar la información de la
 * canción.
 */
function IndexSongsMain() {
    // UI
    // Charts
    get_songs()
        .then((res) => {
        // Charts
        if (Array.isArray(res)) {
            let random = res.sort(() => Math.random() - 0.5);
            random.forEach((song) => {
                const { Album, Artist, Cover, Title, Path } = song;
                const ChartGrid = $(".top-charts-grid");
                const chartCard = ` 
          <div class="chart-card">
          <img src="data:image/webp;base64,${Cover}" alt="" id="chart-img">
          <!-- info -->
          <div class="chart-info">
              <p>${Title}</p>
              <p>${Artist}</p>
          </div>
          <!-- Icons and time -->
          <div class="chart-icons">
              <p>2:00</p>
              <iconify-icon icon='material-symbols:play-circle' class='' onclick="play('${Path}')"></iconify-icon>
              <iconify-icon icon='material-symbols:add-box' class=''></iconify-icon>
          </div>
            </div>`;
                ChartGrid.append(chartCard);
            });
        }
    })
        .catch((err) => {
        console.error("Error", err);
    });
}
function index_artists() {
    let image = [];
    let Artist = [];
    // API request
    const xhttp = (data) => __awaiter(this, void 0, void 0, function* () {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "http://192.168.100.168:8080/uploadArtist",
                type: "GET",
                dataType: "json",
                data: {
                    artist: data,
                },
                success: (response) => {
                    return resolve(response);
                },
                error: (jxqhr, textStatus, errorThrown) => {
                    return reject([jxqhr, textStatus, errorThrown]);
                },
            });
        });
    });
    // Get Artist Image
    handle_artist_image("Natanael Cano.webp").then((Response) => {
        if (typeof Response === "object" && Response !== null) {
            image = [Response];
        }
    });
    // Function get Artists
    handle_artist()
        .then((res) => {
        if (Array.isArray(res)) {
            Artist = res;
            set_UI(image, Artist);
        }
        const artist = res;
        // API request handler
        xhttp(artist)
            .then((res) => {
            console.log(res);
        })
            .catch((err) => {
            console.error("Error", err);
        });
    })
        .catch((err) => {
        console.error("Error", err);
    });
}
function set_UI(image, Artist) {
    // UI
    const artistGrid = $(".artist-grid");
    if (Array.isArray(Artist) && Array.isArray(image) && image.length > 0) {
        const uniqueArtists = Artist.filter((value, index, self) => index === self.findIndex((t) => t.Artist === value.Artist));
        uniqueArtists.forEach((artist) => {
            const { Artist } = artist;
            const artistImage = image[0].find((img) => img.Artist === Artist);
            if (artistImage) {
                const artistCard = `
              <div class="artist-card">
              <img src="data:image/webp;base64,${artistImage.Cover}" alt="" id="artist-img" label="${Artist}" title="${Artist}" lazyload>
              <p>${Artist}</p>
              </div>
              `;
                artistGrid.append(artistCard);
            }
        });
    }
}
// Lo mas reproducido
function mostPlayed() {
    // Use async func
    handle_most_played()
        .then((res) => {
        if (typeof res === "object" && res !== null) {
            const { Album, Artist, Played, Title } = res;
            handle_cover(Title)
                .then((coverResponse) => {
                if (typeof coverResponse === "object" && coverResponse !== null) {
                    const { Cover } = coverResponse;
                    const mostPlayedDiv = $(".card-trending-songs");
                    mostPlayedDiv.css("background-image", `linear-gradient(
                rgba(0, 0, 0, 0.007),
                rgba(195, 12, 79, 0.226)
              ),
              url("data:image/webp;base64,${Cover}")`);
                }
            })
                .catch((CoverErr) => {
                console.error("Error", CoverErr);
            });
            $("#top-title").text(Title);
            $("#top-artist").text(Artist);
        }
    })
        .catch((err) => {
        console.error("Error", err);
    });
}
function listeners_init() {
    const container = $(".content-menu-side");
    const songsBtn = $("#more-charts");
    const closeMenu = $(".close-menu");
    const songsGrid = $(".songs-grid");
    let menuShow = false;
    let ajaxRequested = false;
    // songs btn
    songsBtn.on("click", () => {
        container.toggle();
        if (container.is(":visible")) {
            menuShow = true;
            // close btn
            closeMenu.on("click", () => {
                container.hide();
            });
            if (menuShow === true && !ajaxRequested) {
                handle_songs_async()
                    .then((res) => {
                    if (Array.isArray(res)) {
                        res.forEach((song) => {
                            const { Album, Artist, Cover, Title, Path } = song;
                            const songCard = `
                 <div class="song-card">
                  <img src="data:image/webp;base64,${Cover}" alt="">
                  <p>${Title}</p>
                  <p>${Artist}</p>
                  <h6 style="display: none">${Path}</h6>
                  <span>
                  <iconify-icon icon='material-symbols:play-circle' class='play-icon' title="Play"></iconify-icon>
                  <iconify-icon icon='material-symbols:add-box' class='' title="Add"></iconify-icon>
                  </span>
                 </div>`;
                            songsGrid.append(songCard);
                        });
                    }
                    ajaxRequested = true; // Marcar que la solicitud AJAX se ha realizado
                    addScrollListener(songsGrid); // Agregar el evento de escucha del scroll después de cargar las canciones
                })
                    .catch((err) => {
                    console.error("Error", err);
                });
            }
        }
    });
    let start = 0;
    let end = 15;
    let allSongsLoaded = false; // Variable para controlar si se han cargado todas las canciones
    function addScrollListener(songsGrid) {
        const songsContent = document.querySelector(".songs-content");
        songsContent.addEventListener("scroll", (event) => {
            if (songsContent.scrollTop + songsContent.clientHeight >=
                songsContent.scrollHeight &&
                !allSongsLoaded // Verificar si ya se han cargado todas las canciones
            ) {
                start = end;
                end += 6;
                handle_songs_async(start, end).then((res) => {
                    if (res.length > 0) {
                        if (Array.isArray(res)) {
                            res.forEach((song) => {
                                const { Album, Artist, Cover, Title, Path } = song;
                                const songCard = `
                <div class="song-card">
                  <img src="data:image/webp;base64,${Cover}" alt="">
                  <p>${Title}</p>
                  <p>${Artist}</p>
                  <h6 style="display: none">${Path}</h6>
                  <span>
                   <iconify-icon icon='material-symbols:play-circle' title="Play"></iconify-icon>
                   <iconify-icon icon='material-symbols:add-box' class='' title="Add"></iconify-icon>
                  </span>
                </div>`;
                                songsGrid.append(songCard);
                            });
                        }
                    }
                    else {
                        allSongsLoaded = true; // Actualizar la variable para indicar que no hay más canciones
                    }
                });
            }
        });
    }
}
//# sourceMappingURL=player.js.map