<?php
session_start();
if (isset($_COOKIE['WaveMusicLoged'])) {
    header("location: ../../../../public/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title-doc">WaveMusic | Iniciar sesión</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/public/src/css/colors.css">
    <link rel="stylesheet" href="/public/src/css/login/index.css">
</head>

<body>
    <div class="main-content">
        <!-- Main  -->
        <main>
            <!-- Left Side -->
            <div class="left">
                <aside>
                    <h1>WaveMusic</h1>
                    <p>Obten acceso a tu musica favorita con WaveMusic.</p>
                </aside>
            </div>
            <!-- Right Side -->
            <div class="right">
                <aside>
                    <!-- Title -->
                    <h1 id="switch-title">Inicia Sesion</h1>
                    <span>
                        <p id="switch-p">No tienes una cuenta?</p>
                        <a onclick="changeForm()" id="switch-a">Registarse</a>
                    </span>
                    <!-- Social Login -->
                    <div class="social-login">
                        <!-- Google -->
                        <span class="social-icons" title="Continuar con Google">
                            <iconify-icon icon='devicon:google' class=''></iconify-icon>
                            <p>Continuar con Google</p>
                        </span>
                        <!-- Facebook -->
                        <span class="social-icons" title="Continuar con Facebook">
                            <iconify-icon icon='devicon:facebook' class=''></iconify-icon>
                            <p>Continuar con Facebook</p>
                        </span>
                    </div>
                    <!-- Form -->
                    <div class="form" id="logForm">
                        <form action="/private/src/server/php/login/checkUser.php" method="GET">
                            <div class="input">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" required autocomplete="off">
                            </div>
                            <div class="input">
                                <label for="password">Contraseña</label>
                                <input type="password" name="pass" id="password" required autocomplete="off">
                            </div>
                            <div class="input">
                                <input type="submit" value="Iniciar Sesion">
                            </div>

                        </form>
                        <!-- ShowErrors -->
                        <div class="errorMsgLogin" style="display: none;">
                            <h1></h1>
                            <p></p>
                        </div>
                    </div>
                    <!-- Form reg -->
                    <div class="form" style="display: none;" id="regForm">
                        <form action="/private/src/server/php/login/altUser.php" method="POST">
                            <!-- Name -->
                            <div class="input">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" required autocomplete="off">
                            </div>
                            <!-- Email -->
                            <div class="input">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required autocomplete="email">
                            </div>
                            <!-- Username -->
                            <div class="input">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="RegUsername" required autocomplete="off">
                            </div>
                            <!-- Password -->
                            <div class="input">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="RegPassword" required autocomplete="off">
                            </div>
                            <!-- Error check -->
                            <div id="error" style="display: none;">
                                <p>Las contraseñas deben ser de 8 caracteres</p>
                            </div>
                            <div class="input">
                                <input type="submit" value="Registrarse">
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
        </main>
    </div>
    <!-- Iconify -->
    <script src="/public/src/js/webpack/iconify.js"></script>
    <!-- Jquery and Scripts -->
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script src="/public/src/js/login/login.js"></script>
    <script type="module" src="/public/src/js/Error/errorHandler.js"></script>
</body>

</html>