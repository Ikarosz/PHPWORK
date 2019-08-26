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
                <?php
                $sql1 = "SELECT * FROM beosztas";

                $lekerdezes = $kapcsolat->query($sql1);
                echo "<table>";
                echo "<tr>";
                echo "<td>OID </td>";
                echo "<td>razon </td>";
                echo "<td>datum </td>";
                echo "<td>rendeles_tipusa </td>";
                echo "<td>bazon </td>";
                echo "<td>oraszam </td>";
                echo "</tr>";

                while($sor=$lekerdezes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$sor[OID] </td>";
                    echo "<td>$sor[razon] </td>";
                    echo "<td>$sor[datum] </td>";
                    echo "<td>$sor[rendeles_tipusa] </td>";
                    echo "<td>$sor[bazon] </td>";
                    echo "<td>$sor[oraszam] </td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
            <div id="bal">
<a href="Login.php"><img class="haz" src="kepek/haz.png" alt="haz"/> Login</a> 
<a href="Regisztracio.php"><img class="haz" src="kepek/haz.png" alt="haz"/> Regisztráció</a> 
               
                
                
                
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
