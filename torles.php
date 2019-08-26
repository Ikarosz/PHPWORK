<?php
include_once './kapcsolati adatok.php';
?>
<html lang="hu-HU">
    <head>
        <meta charset="UTF-8">
        <title>Gyakorló</title>
        <link href="stilus.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="tartalom">
            <header>
                <img id="banner" src="kepek/banner.jpg" alt="banner">
            </header>
            <div id="jobb">
                <nav>
                   <a href="uj.php"><img class="haz" src="kepek/haz.png" alt="haz"/> Új</a> 
                    <a href="kereses.php"><img class="haz" src="kepek/haz.png" alt="haz"/>Keresés</a> 
                    <a href="modositas.php"><img class="haz" src="kepek/haz.png" alt="haz"/>Módosítás</a> 
                    <a href="torles.php"><img class="haz" src="kepek/haz.png" alt="haz"/>Törlés</a>

                </nav>
            </div>
            <div id="kozep">
               <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            if (isset($_POST['submit_x'])) {
                foreach ($_POST['torol'] as $torol_akod) {
                    $sql5 = "DELETE FROM orvosok WHERE OID=$torol_akod";
                    $kapcsolat->query($sql5) or die('Hiba törléskor');
                }
                echo 'A kijelöltek törölve. <br>';
                }
                ?>
            
                <label>Orvosok:</label><br>
                
                <?php
                $sql4 = "SELECT * FROM orvosok;";
                $eredmeny = $kapcsolat->query($sql4) or die("Hiba a tábla lekérdezésekor");
                while ($row = $eredmeny->fetch_assoc()) {
                    echo "<input type='checkbox' name='torol[]' value='" . $row['OID'] . "'> ";
                    echo $row['OID'] . ", " . $row['nev'] . ", " . $row['szakterulet'] .", " . $row['mukodesi_azonosito'] . ", " . $row['email'] .", " . $row['tel'] . ", " . $row['ugyeleti_oraszam'] . ".";
                    echo "<br>";
                }

                $kapcsolat->close();
                ?>

                <br>
                <input type="submit" name="submit" src="kepek/torol.png" alt="töröl" id="submit" value="Töröl">
            </form>
            </div>
            <div id="bal">

            </div>
            <footer>
                <div id="logo">
                    <img id="logo2" src="kepek/logo.jpg" alt="logo"/>
                </div>
                <div id="adatok">
                    <object data="cegadat.txt"></object>
                    <!--                    <embed src="cegadat.txt">-->
                </div>
            </footer>
        </div>
    </body>
</html>




