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
               $SQL="";
               if(isset($_POST['mod_x']) && (isset($_POST['nev']) OR isset($_POST['szt']) OR isset($_POST['ma'])OR isset($_POST['mail'])OR isset($_POST['tszam'])OR isset($_POST['uo']))){
                   $SQL='UPDATE `orvosok` SET ';
                   if(!empty($_POST['nev'])){
                       $SQL.=' `nev`="'.$_POST['nev'].'" ';
                   }
                   
                   if(!empty($_POST['szt'])){
                       $SQL.=' `szakterulet`="'.$_POST['szt'].'" ';
                   }
                   
                   if(!empty($_POST['ma'])){
                       $SQL.=' `mukodesi_azonosito`="'.$_POST['ma'].'" ';
                   }
                   
                   if(!empty($_POST['mail'])){
                       $SQL.=' `email`="'.$_POST['mail'].'" ';
                   }
                   
                    if(!empty($_POST['tszam'])){
                       $SQL.=' `tel`="'.$_POST['tszam'].'" ';
                   }
                   
                   if(!empty($_POST['uo'])){
                       $SQL.=' `ugyeleti_oraszam`="'.$_POST['uo'].'" ';
                   }
                    $SQL.='  WHERE `OID`="'.$_POST['oid'].'" ';
                   // echo $SQL."<br>";
                      $lekerdezes=$kapcsolat->query($SQL) or die("hiba a módosító lekérdezéskor");
               }
             
               //alapadatok kiiratása
                $sql1 = "SELECT * FROM orvosok";

                $lekerdezes = $kapcsolat->query($sql1);
                echo "<table>";
                echo "<tr>";
                echo "<td>OID </td>";
                echo "<td>név </td>";
                echo "<td>szakterulet </td>";
                echo "<td>Működési azonosító </td>";
                echo "<td>email </td>";
                echo "<td>tel </td>";
                echo "<td>Ügyeleti Óraszám </td>";


                while($sor=$lekerdezes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$sor[OID] </td>";
                    echo "<td>$sor[nev] </td>";
                    echo "<td>$sor[szakterulet] </td>";
                    echo "<td>$sor[mukodesi_azonosito] </td>";
                    echo "<td>$sor[email] </td>";
                    echo "<td>$sor[tel] </td>";
                    echo "<td>$sor[ugyeleti_oraszam] </td>";
                    echo "</tr>";
                }
                echo "</table><br>";
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    
                     <label for="oid">Orvos azonosító</label>
                    <select name='oid'>
                        <?php 
                        $SQL0="SELECT `OID` FROM `orvosok`";
                        $lekerdezes=$kapcsolat->query($SQL0);
                        while($sor=$lekerdezes->fetch_assoc()){
                            echo '<option value="'.$sor['OID'].'">';
                            echo $sor['OID'];
                            echo '</option>';
                        }
                        ?>
                        
                    </select>
                     <br>
                    <label for="nev">Név</label>
                    <input type="text" name="nev" id="nev" >
                    <br>
                    <label for="szt">Szakterulet: </label>
                    <input type="text" name="szt" id="szt" >
                    <br><label for="ma">Működési azonostó: </label>
                    <input type="text" name="ma" id="ma" >
                    <br><label for="mail">E-mail: </label>
                    <input type="email" name="mail" id="mail" >
                    <br><label for="tszam">Telefonszám: </label>
                    <input type="tel" name="tszam" id="tszam" >
                    <br><label for="uo">Ügyeleti óraszám: </label>
                    <input type="number" name="uo" id="uo" >
                    <br>
                    <input type="image" src="kepek/modosit.png" alt="módosít" height="20" width="20" name="mod" id="mod" value="mod">
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

