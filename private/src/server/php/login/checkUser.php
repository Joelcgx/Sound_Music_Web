<?php
include_once('../class/conn.php');

$conn = Connections::Mysql();

try {
    // Verificar las variables GET
    if (isset($_GET['username']) && isset($_GET["pass"])) {
        $username = htmlspecialchars($_GET['username']);
        $password = htmlspecialchars($_GET["pass"]);
    }
    // Sql query
    $query = "SELECT Username, Password,ID from users WHERE Username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($result[0])) {
        header("location: ../../../../../public/docs/login.php?error=userNotFound", true);
        exit();
    } else {
        if ($result && password_verify($password, $result[0]["Password"])) {
            session_start();
            $_SESSION['ID'] = $result[0]["ID"];
            setcookie("UserNameWavem", $result[0]["Username"], time() + (60 * 24 * 60 * 60), '/');
            setcookie("WavemLoged", $result[0]["ID"], time() + (60 * 24 * 60 * 60), '/');
            header("location: ../../../../../public/index.php");
            exit();
        } else {
            header("location: ../../../../../public/docs/login.php?error=passwordIncorrect");
            exit();
        }
    }
} catch (Exception $Excepcion) {
    header("location: ../../../../../public/docs/login.php?error=" . $Excepcion, true);
    exit();
}
