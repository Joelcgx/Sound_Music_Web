var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
/**
 * Esta función de TypeScript recupera de forma asincrónica datos del índice de música y los devuelve o
 * un error si se encuentra.
 * @returns La función `get_songs` devuelve una Promesa que se resuelve en una cadena, una matriz de
 * cadenas o un valor desconocido.
 */
export function get_songs() {
    return __awaiter(this, void 0, void 0, function* () {
        const response = yield get_music_index();
        try {
            return response;
        }
        catch (error) {
            return error;
        }
    });
}
export function handle_artist() {
    return __awaiter(this, void 0, void 0, function* () {
        const response = yield get_artists();
        try {
            return response;
        }
        catch (error) {
            throw new Error(`Ocurrio un error al obtener los artistas: Error=> ${error}`);
        }
    });
}
export function handle_artist_image(artistName) {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield get_artist_image(artistName);
            return response;
        }
        catch (error) {
            return error;
        }
    });
}
export function handle_most_played() {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield get_most_played_fromDB();
            return response;
        }
        catch (error) {
            return error;
        }
    });
}
export function handle_cover(Title) {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield get_cover(Title);
            return response;
        }
        catch (error) {
            return error;
        }
    });
}
export function handle_songs_async(start, end) {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield get_songs_async(start, end);
            return response;
        }
        catch (error) {
            return error;
        }
    });
}
// AJAX requests
/**
 * La función `get_music_index` realiza una solicitud AJAX a un controlador PHP para recuperar una
 * lista de índice de canciones de forma asincrónica.
 * @returns La función `get_music_index` devuelve una Promesa que se resuelve con una cadena o una
 * matriz de cadenas.
 */
function get_music_index() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_songs_index",
            },
            success: function (data) {
                return resolve(data);
            },
            error: function (data) {
                return reject(data);
            },
        });
    });
}
function get_artists() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_artist",
            },
            success: (data) => {
                return resolve(data);
            },
            error: (Error) => {
                return reject(Error);
            },
        });
    });
}
function get_artist_image(artistName) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_artist_image",
                artist: artistName,
            },
            success: (data) => {
                return resolve(data);
            },
            error: (Error) => {
                return reject(Error);
            },
        });
    });
}
function get_most_played_fromDB() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_most_played",
            },
            success: (data) => {
                return resolve(data);
            },
            error: (Error) => {
                return reject(Error);
            },
        });
    });
}
function get_cover(title) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_Cover",
                song: title,
            },
            success: (data) => {
                return resolve(data);
            },
            error: (Error) => {
                return reject(Error);
            },
        });
    });
}
function get_songs_async(start, end) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/private/src/server/php/handler/handler.php",
            type: "GET",
            dataType: "json",
            data: {
                function: "get_songs_async",
                start: start,
                end: end,
            },
            success: (data) => {
                return resolve(data);
            },
            error: (Error) => {
                return reject(Error);
            },
        });
    });
}
//# sourceMappingURL=get.js.map