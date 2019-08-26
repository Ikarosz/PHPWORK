<?php
 
define("HOST", '127.0.0.1');
define("FNEV", "root");
define("JELSZO", '');
define("ABNEV", "ugyelet");

$kapcsolat = new mysqli(HOST, FNEV, JELSZO, ABNEV);

if ($kapcsolat->connect_error) {
    die("Hiba az adatbázishoz kapcsolódáskor: " . $kapcsolat->connect_error);
}

/* Magyar ékezetes betűk jól működése */
$kapcsolat->query("SET NAMES UTF8");
$kapcsolat->query("set character set UTF8");
$kapcsolat->query("set collation_connection='utf8_hungary_ci'");
?>

