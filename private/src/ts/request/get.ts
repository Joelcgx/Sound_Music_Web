/**
 * Esta función de TypeScript recupera de forma asincrónica datos del índice de música y los devuelve o
 * un error si se encuentra.
 * @returns La función `get_songs` devuelve una Promesa que se resuelve en una cadena, una matriz de
 * cadenas o un valor desconocido.
 */
export async function get_songs(): Promise<string | string[] | unknown> {
  const response = await get_music_index();
  try {
    return response;
  } catch (error) {
    return error;
  }
}

export async function handle_artist() {
  const response = await get_artists();
  try {
    return response;
  } catch (error) {
    throw new Error(
      `Ocurrio un error al obtener los artistas: Error=> ${error}`
    );
  }
}

export async function handle_artist_image(artistName: string | string[]) {
  try {
    const response = await get_artist_image(artistName);
    return response;
  } catch (error) {
    return error;
  }
}
export async function handle_most_played(): Promise<
  String | String[] | unknown
> {
  try {
    const response = await get_most_played_fromDB();
    return response;
  } catch (error) {
    return error;
  }
}

export async function handle_cover(
  Title: string
): Promise<String | String[] | unknown> {
  try {
    const response = await get_cover(Title);
    return response;
  } catch (error) {
    return error;
  }
}

export async function handle_songs_async(
  start?: number,
  end?: number
): Promise<String | String[] | unknown> {
  try {
    const response = await get_songs_async(start, end);
    return response;
  } catch (error) {
    return error;
  }
}
// AJAX requests
/**
 * La función `get_music_index` realiza una solicitud AJAX a un controlador PHP para recuperar una
 * lista de índice de canciones de forma asincrónica.
 * @returns La función `get_music_index` devuelve una Promesa que se resuelve con una cadena o una
 * matriz de cadenas.
 */
function get_music_index(): Promise<string | string[]> {
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

function get_artist_image(artistName: string | string[]) {
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

function get_most_played_fromDB(): Promise<String | String[]> {
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

function get_cover(title: string): Promise<String | String[]> {
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

function get_songs_async(
  start?: number,
  end?: number
): Promise<String | String[]> {
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
