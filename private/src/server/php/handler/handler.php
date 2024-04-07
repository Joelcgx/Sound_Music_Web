<?php
if (isset($_GET['function']) && function_exists($_GET['function'])) {
    $funName  = $_GET['function'];

    $response = call_user_func($funName);
    echo $response;
}


/**
 * La función `get_songs_index` recupera información sobre archivos MP3 de un servidor FTP, analiza los
 * archivos usando getID3 y devuelve una matriz de metadatos musicales codificados en JSON.
 * 
 * @return string La función `get_songs_index()` devuelve una matriz codificada en JSON de información
 * de archivos de música que incluye imagen de portada, título, artista, álbum y ruta. Si hay un error
 * durante el proceso, devuelve una matriz codificada en JSON con un mensaje de error.
 */
function get_songs_index(): string
{
    include_once '../class/conn.php';
    include_once '../class/getid3/getid3.php';
    $FTP = Connections::Ftp();
    $getID3 = new getID3();
    try {
        if (!$FTP) {
            throw new Exception('Could not connect to FTP server');
        }
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start = $_GET['start'];
            $end = $_GET['end'];
        } else {
            $start = 0;
            $end = 6;
        }

        $Files = ftp_nlist($FTP, './');

        $music_files = array_filter($Files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) == "mp3";
        });
        $initFiles = array_slice($music_files, $start, $end);

        $music_index = [];

        foreach ($initFiles as $files) {
            $localPath = "../temp/" . $files;
            $remotePath = "./" . $files;

            if (ftp_get($FTP, $localPath, $remotePath, FTP_BINARY)) {
                $FileInfo = $getID3->analyze($localPath);
                if ($FileInfo !== false) {
                    if ($FileInfo["comments"]) {
                        $song_path = ltrim($remotePath, './');
                        $music_index[] = [
                            "Cover" => base64_encode($FileInfo["comments"]["picture"][0]["data"]),
                            "Title" => $FileInfo["id3v2"]["comments"]["title"][0],
                            "Artist" => $FileInfo["id3v2"]["comments"]["artist"][0],
                            "Album" => $FileInfo["id3v2"]["comments"]["album"][0],
                            "Path" => $song_path
                        ];
                    }
                }
            }
            unlink($localPath);
        }
        return json_encode($music_index);
    } catch (Exception $th) {
        return json_encode(['error' => $th->getMessage()]);
    }
}

/**
 * La función `PlaySong` recupera información y metadatos del archivo de audio de un servidor FTP y los
 * devuelve en formato JSON.
 * 
 * @return string La función `PlaySong()` devuelve una cadena codificada en JSON que contiene
 * información sobre una canción. Los datos devueltos incluyen la fuente de audio codificada en base64,
 * el título, el artista, el álbum, el género y la imagen de portada de la canción. Si ocurre una
 * excepción durante el proceso, la función devolverá una cadena codificada en JSON que contiene el
 * mensaje de excepción.
 */
function PlaySong(): string
{
    include_once '../class/conn.php';
    include_once '../class/getid3/getid3.php';

    $FTP = Connections::Ftp();
    $getID3 = new getID3();
    try {
        $song = $_GET['song'];
        $TempPath =  "../temp/" . $song;

        ob_start();
        if (ftp_get($FTP, "php://output", "./" . $song, FTP_BINARY)) {
            $audio = ob_get_contents();
            if (ftp_get($FTP, $TempPath, "./" . $song, FTP_BINARY)) {
                $FileInfo = $getID3->analyze($TempPath);
                if ($FileInfo["comments"]) {
                    $title = $FileInfo["id3v2"]["comments"]["title"][0];
                    $artist = $FileInfo["id3v2"]["comments"]["artist"][0];
                    $album  = $FileInfo["id3v2"]["comments"]["album"][0];
                    $genre = $FileInfo["id3v2"]["comments"]["genre"][0];
                    $cover = base64_encode($FileInfo["comments"]["picture"][0]["data"]);
                }
            }
            ob_end_clean();
        }
        unlink($TempPath);
        return json_encode([
            "AudioSource" => base64_encode($audio),
            "Title" => $title,
            "Artist" => $artist,
            "Album" => $album,
            "Genre" => $genre,
            "Cover" => $cover
        ]);
    } catch (Exception $exception) {
        return json_encode($exception->getMessage());
    }
}


function get_artist(): string
{
    include_once '../class/conn.php';
    include_once '../class/getid3/getid3.php';
    $FTP = Connections::Ftp();
    $getID3 = new getID3();
    try {
        if (!$FTP) {
            throw new Exception('Could not connect to FTP server');
        }
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start = $_GET['start'];
            $end = $_GET['end'];
        } else {
            $start = 0;
            $end = 6;
        }

        $Files = ftp_nlist($FTP, './');

        $music_files = array_filter($Files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) == "mp3";
        });
        $initFiles = array_slice($music_files, $start, $end);

        $music_index = [];

        foreach ($initFiles as $files) {
            $localPath = "../temp/" . $files;
            $remotePath = "./" . $files;

            if (ftp_get($FTP, $localPath, $remotePath, FTP_BINARY)) {
                $FileInfo = $getID3->analyze($localPath);
                if ($FileInfo !== false) {
                    if ($FileInfo["comments"]) {
                        $music_index[] = [
                            "Artist" => $FileInfo["id3v2"]["comments"]["artist"][0],
                        ];
                    }
                }
            }
            unlink($localPath);
        }
        return json_encode($music_index);
    } catch (Exception $th) {
        return json_encode(['error' => $th->getMessage()]);
    }
}

function get_artist_image(): string
{
    include_once '../class/conn.php';
    $FTP = Connections::Ftp();

    try {
        if (!$FTP) {
            throw new Exception('Could not connect to FTP server');
        }

        if (isset($_GET['artist'])) {
            $artist = $_GET['artist'];
        } else {
            return json_encode(['error' => 'Artist not found']);
        }

        $dir = "Artist";
        ftp_chdir($FTP, $dir);
        $Files = ftp_nlist($FTP, './');
        $ArtistCovers = array_filter($Files, function ($file) use ($artist) {
            return pathinfo($file, PATHINFO_EXTENSION) == "webp";
        });

        $coversIndex = [];
        ob_start();
        foreach ($ArtistCovers as $cover) {
            if (ftp_get($FTP, "php://output", "./" . $cover, FTP_BINARY)) {
                $binaryData = ob_get_contents(); // Capturar el contenido binario antes de limpiar el buffer
                ob_end_clean(); // Limpiar el buffer antes de codificar el contenido binario en base64

                $base64Data = base64_encode($binaryData);
                $artistWhitoutExtension = str_replace(".webp", "", $cover);
                $coversIndex[] = [
                    "Artist" => str_replace("./", "", $artistWhitoutExtension),
                    "Cover" => $base64Data,
                ];
            }
            ob_start();
        }
        return json_encode($coversIndex);
    } catch (Throwable $th) {
        return json_encode(['error' => $th->getMessage()]);
    }
}
