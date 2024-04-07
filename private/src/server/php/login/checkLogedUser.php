<?php
// Check if user is logged in
if (!isset($_COOKIE['WavemLoged']) && !isset($_COOKIE['UserNameWavem'])) {
    header("location:" . $_SERVER['DOCUMENT_ROOT'] . "/public/docs/login.php");
}
