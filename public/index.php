<?php
include_once('/Website/private/src/server/php/login/checkLogedUser.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wavem | incio</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/public/src/css/colors.css">
    <link rel="stylesheet" href="/public/src/css/index/index.css">
</head>

<body>
    <div class="main-content">
        <!-- Left Side or Aside -->
        <aside>
            <!-- Title app -->
            <div class="title-app">
                <h1>WaveMusic</h1>
            </div>
            <!-- Menu Aside -->
            <div class="menu-aside">
                <p>Menu</p>
                <!-- Options -->
                <!-- Home and active -->
                <div class="opt-aside" id="active" title="Inicio">
                    <iconify-icon icon='material-symbols:home' class='home-aside-icon'></iconify-icon>
                    <p>Inicio</p>
                </div>
                <!-- Genres  -->
                <div class="opt-aside" title="Generos">
                    <iconify-icon icon='material-symbols:genres' class=''></iconify-icon>
                    <p>Generos</p>
                </div>
                <!-- Albums -->
                <div class="opt-aside" title="Albumes">
                    <iconify-icon icon='material-symbols:album' class=''></iconify-icon>
                    <p>Albums</p>
                </div>
                <!-- Artists -->
                <div class="opt-aside" title="Artistas">
                    <iconify-icon icon='material-symbols:artist' class=''></iconify-icon>
                    <p>Artistas</p>
                </div>
            </div>
            <!-- Library -->
            <div class=" library-aside">

                <p>Library</p>
                <!-- Options -->
                <!-- Recent -->
                <div class="opt-aside" title="Recientes">
                    <iconify-icon icon='material-symbols:history' class=''></iconify-icon>
                    <p>Recientes</p>
                </div>
                <!-- Favorites -->
                <div class="opt-aside" title="Favoritos">
                    <iconify-icon icon='material-symbols:favorite' class=''></iconify-icon>
                    <p>Favoritos</p>
                </div>
                <!-- Local Files -->
                <div class="opt-aside" title="Local">
                    <iconify-icon icon='material-symbols:folder' class=''></iconify-icon>
                    <p>Local</p>
                </div>
            </div>
            <!-- Playlists -->
            <div class="playlist-aside">
                <p>Playlists</p>
                <!-- Options -->
                <!-- New Playlists -->
                <div class="opt-aside" title="Nueva Playlist">
                    <iconify-icon icon='material-symbols:add-box' class=''></iconify-icon>
                    <p>Nueva Playlist</p>
                </div>
            </div>
        </aside>
        <!-- Right Side the document -->
        <div class="main">
            <!-- Header -->
            <header>
                <!-- NAV -->
                <nav>
                    <!-- Lefy items -->
                    <div class="left-nav">
                        <p id="header-active">Musica</p>
                        <p>Podcast</p>
                        <p>Live</p>
                    </div>
                    <!-- Center items -->
                    <div class="center-nav">
                        <!-- Search -->
                        <span>
                            <iconify-icon icon='material-symbols:search-rounded' class='center-nav-icon'></iconify-icon>
                            <input type="search" name="" id="" placeholder="Buscar">
                        </span>
                    </div>
                    <!-- Right items -->
                    <div class="right-nav">
                        <iconify-icon icon='material-symbols:settings' class='nav-right-icon' title="Configuracion"></iconify-icon>
                        <!-- User photo -->
                        <div class="user-photo" title="Usuario">
                            <img src="/public/src/assets/cover.svg" alt="user">
                            <p><?php if (isset($_COOKIE["UserNameWavem"])) {
                                    echo $_COOKIE["UserNameWavem"];
                                } ?></p>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- Content main -->
            <main>
                <!-- Home -->
                <div class="home-content">
                    <p>La Cancion mas Escuchada</p>
                    <!-- Card main -->
                    <div class="card-trending-songs">
                        <span>
                            <h1 id="top-title">10 Segundos</h1>
                            <p id="top-artist">Natanael Cano</p>
                            <p>Reproducciones</p>
                        </span>

                    </div>
                    <!-- Cards and player-->
                    <div class="card-container">
                        <!-- Cards -->
                        <div class="cards">
                            <!-- Artist -->
                            <p>Artistas</p>
                            <div class="artists">
                                <!-- Grid -->
                                <div class="artist-grid">
                                    <!-- Card -->
                                    <!-- <div class="artist-card">
                                        <img src="https://e-cdns-images.dzcdn.net/images/artist/3afa81d065245355854d803b55b66681/162x162-000000-80-0-0.jpg" alt="">
                                        <p>Artist</p>
                                    </div> -->
                                    <!-- Iterar XD -->
                                </div>
                                <p>Ver mas</p>
                            </div>
                            <!-- DIV -->
                            <div class="cards-bottom">
                                <!-- Generes -->
                                <div class="genres">
                                    <span>
                                        <p>Generos</p>
                                        <p id="more-genres">Ver mas</p>
                                    </span>
                                    <!-- Grid -->
                                    <div class="genre-grid">
                                        <!-- Card -->
                                        <div class="genre-card">
                                            <p>CT</p>
                                        </div>
                                        <!-- TEST APP -->
                                        <div class="genre-card">
                                            <p>CT</p>
                                        </div>
                                        <div class="genre-card">
                                            <p>CT</p>
                                        </div>
                                        <div class="genre-card">
                                            <p>CT</p>
                                        </div>
                                        <!-- TEST APP END -->
                                    </div>
                                </div>
                                <!-- Top charts -->
                                <div class="top-charts">
                                    <span>
                                        <p>Top Canciones</p>
                                        <p id="more-charts">Ver mas</p>
                                    </span>
                                    <!-- GRID -->
                                    <div class="top-charts-grid">
                                        <!-- Card -->
                                        <!-- <div class="chart-card">
                                            <img src="https://e-cdns-images.dzcdn.net/images/cover/6b1b5e9c9f4b9c7f2b4c0b6a6d8f9a5f/68x68-000000-80-0-0.jpg" alt=""> -->
                                        <!-- info -->
                                        <!-- <div class="chart-info">
                                                <p>Title</p>
                                                <p>Artist</p>
                                            </div> -->
                                        <!-- Icons and time -->
                                        <!-- <div class="chart-icons">
                                                <p>2:00</p>
                                                <iconify-icon icon='material-symbols:play-circle' class=''></iconify-icon>
                                                <iconify-icon icon='material-symbols:add-box' class=''></iconify-icon>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Player -->
                        <div class="player-rigth">
                            <!--span -->
                            <span>
                                <p>Player</p>
                                <iconify-icon icon='material-symbols:equalizer' class=''></iconify-icon>
                            </span>
                            <!-- Img and progress -->
                            <div class="player-info">
                                <img alt="" id="player-cover">
                                <h2 id="player-title">Title</h2>
                                <p id="player-artist">Artist</p>
                                <!-- Progress -->
                                <span>
                                    <p id="player-currentTime">00:00</p>
                                    <div class="player-progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                    <p id="player-duration">00:00</p>
                                </span>
                            </div>
                            <!-- Player -->
                            <audio src="" id="player-audio"></audio>
                            <!-- Controls -->
                            <div class="player-controls">
                                <iconify-icon icon='material-symbols:shuffle' class='player-icon'></iconify-icon>
                                <iconify-icon icon='material-symbols:skip-previous' class='player-icon'></iconify-icon>
                                <iconify-icon icon='material-symbols:play-circle' class='player-icon'></iconify-icon>
                                <iconify-icon icon='material-symbols:skip-next' class='player-icon'></iconify-icon>
                                <iconify-icon icon='material-symbols:repeat' class='player-icon'></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Content menu side -->
    <div class="content-menu-side">
        <!-- Content -->
        <div class="menu">
            <div class="menu-items">
                <p id="menu-title">Canciones</p>
                <span>
                    <iconify-icon icon='material-symbols:close' class='close-menu'></iconify-icon>
                </span>
            </div>
        </div>
        <!-- Content -->
        <div class="content-center">
            <!-- Canciones -->
            <div class="songs-content">
                <!-- Canciones Grid -->
                <div class="songs-grid">
                    <!-- Card -->
                    <!-- <div class="song-card">
                        <img src="https://e-cdns-images.dzcdn.net/images/cover/6b1b5e9c9f4b9c7f2b4c0b6a6d8f9a5f/100x100-000000-80-0-0.jpg" alt="">
                        <p>Title</p>
                        <p>Artist</p>
                        <span>
                            <iconify-icon icon='material-symbols:play-circle' class='play-icon' title="Play"></iconify-icon>
                            <iconify-icon icon='material-symbols:add-box' class='' title="Add"></iconify-icon>
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Iconify -->
    <script src="/public/src/js/webpack/iconify.js"></script>
    <!-- Jquery and Scripts -->
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script type="module" src="/public/src/js/Player/player.js"></script>
    <script src="/public/src/js/Player/playSong.js"></script>
</body>

</html>