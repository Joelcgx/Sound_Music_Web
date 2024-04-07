<?php
class Connections
{
    public static function Mysql(): PDO | false
    {
        $config = json_decode(file_get_contents("../conf/hosts.json"), true);
        $host = $config['hostDB'];
        $port = $config['portDB'];
        $user = $config['userDB'];
        $password = $config['passDB'];
        $database = $config['nameDB'];

        $dsn =  'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database;
        $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        if ($pdo) {
            return $pdo;
        } else {
            return false;
        }
    }
    // FTP
    public static function Ftp(): FTP\Connection |false
    {
        $config = json_decode(file_get_contents("../conf/hosts.json"), true);
        $host = $config['hostFTP'];
        $user = $config['userFTP'];
        $password = $config['passFTP'];

        $FTP = ftp_connect($host);
        if (ftp_login($FTP, $user, $password)) {
            return $FTP;
        } else {
            return false;
        }
    }
}
