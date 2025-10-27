<?php
/***********************************************************************
 * db_config.php
 ***********************************************************************/

$db_host = "zimalofo.mysql.db.internal";  // beim FHGR Edu-Server und xampp steht hier "localhost"
$db_name = "zimalofo_wp1";                 // Edu-Server: "650665_4_1", xampp: "sensor2website"
$db_user = "zimalofo_wp1";           // Edu-Server: "650665_4_1", xampp: "root"
$db_pass = "rpwfeXRPuF9";               // Edu-Server: "=rTjuEQDYvC9", xampp: ""

$db_charset = "utf8";

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Erstellt eine neue PDO-Instanz mit der Konfiguration aus config.php
$pdo = new PDO($dsn, $db_user, $db_pass, $options);

// echo "Datenbank-Verbindung erfolgreich hergestellt.<br>";

?>

