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
               
                
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    
                    <label for="kereses">Rendeles típusa</label>
                    <input type="text" name="kereses" id="kereses" required>
                    <br>
                    <input type="submit" value="Keres" name="kere" id="kere">
                </form>
                <?php 
                
                if(isset($_POST['kere']) && isset($_POST['kereses']))
                {
                   $kszo=$_POST['kereses'];
                    
                    //adat ellenőrzés
                    if(isset($kszo)){
                        $sql4='SELECT * FROM `nyilvantartas` WHERE `hetfo`="'.$kszo.'" OR `kedd`="'.$kszo.'" OR `szerda`="'.$kszo.'" OR `csutortok`="'.$kszo.'" OR `pentek`="'.$kszo.'" OR `szombat`="'.$kszo.'" OR `vasarnap`="'.$kszo.'" OR `RAZON`="'.$kszo.'" ;';
                    }else
                    {
                        echo "Nincs keresési érték beállítva.";
                    }
                    
                $lekerdezes=$kapcsolat->query($sql4) or die("hiba a lekérdezéskor");
                echo "<table>";
                echo "<tr>";
                echo "<td>RAZON </td>";
                echo "<td>hetfo </td>";
                echo "<td>kedd </td>";
                echo "<td>szerda </td>";
                echo "<td>csutortok </td>";
                echo "<td>pentek </td>";
                echo "<td>szombat </td>";
                echo "<td>vasarnap </td>";
                echo "</tr>";

                while($sor=$lekerdezes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$sor[RAZON] </td>";
                    echo "<td>$sor[hetfo] </td>";
                    echo "<td>$sor[kedd] </td>";
                    echo "<td>$sor[szerda] </td>";
                    echo "<td>$sor[csutortok] </td>";
                    echo "<td>$sor[pentek] </td>";
                    echo "<td>$sor[szombat] </td>";
                    echo "<td>$sor[vasarnap] </td>";
                    echo "</tr>";
                }
                echo "</table>";
                    
                }
                    
               ?>
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

