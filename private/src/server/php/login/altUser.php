<?php
include_once('../class/conn.php');

$conn = Connections::Mysql();

try {
    // Determine if las variables are set
    if (isset($_POST['name']) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $ID = rand(1024, 1000000);
    }
    $passHASh = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (Name,Username,Mail,ID,Password,Playlist) VALUES(:name,:username,:email,:ID,:password,'{}')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $passHASh);
    $stmt->bindParam(":ID", $ID);
    if ($stmt->execute()) {
        session_start();

        $_SESSION['ID'] = $ID;
        setcookie("WavemLoged", $ID, time() + (60 * 24 * 60 * 60), "/");

        header('Location: ../../../../../public/index.php', true, 200);
    }
} catch (Exception $Excepcion) {
    header('Location: ../../../../../public/docs/login.php?error=' . $Excepcion->getCode(), true, 302);
    exit();
}
