<?php
include_once './kapcsolati adatok.php';
?>
<html lang="hu-HU">
    <head>
        <meta charset="UTF-8">
        <title>Gyakorló</title>
        <link href="stilus.css" rel="stylesheet" type="text/css"/>
        <link href="stilus2.css" rel="stylesheet" type="text/css"/>
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
 <a  id="asd">asdasdasdas</a>
 <button onclick="asd()" value="asd">
                </nav>
                 <buttom onclick="asd()"></buttom>
                           <label id="asd"></label>
            </div>
            <div id="kozep">
                
            </div>
            <div id="bal">
                <?php 
                
                if(isset($_POST['ujkuld_x']))
                {
                    $oid=$_POST['oid'];
                    $razon=$_POST['razon'];
                    $datum=$_POST['datum'];
                    $rendeles_tipusa=$_POST['rendeles_tipusa'];
                    
                    $oraszam=$_POST['oraszam'];
                    
                    //adat ellenőrzés
                    if(isset($razon) && isset($datum) && isset($rendeles_tipusa) && isset($oid) && isset($oraszam)){
                        $SQL3='INSERT INTO `beosztas`(`OID`, `razon`, `datum`, `rendeles_tipusa`, `oraszam`) VALUES ("'.$oid.'","'.$razon.'","'.$datum.'","'.$rendeles_tipusa.'","'.$oraszam.'");';
                    }
                
                    $lekerdezes2=$kapcsolat->query($SQL3) or die("hiba a lekérdezéskor");
                    if($lekerdezes2)
                    {
                        echo "Sikeres feltöltés";
                    }else
                    {
                        echo "Sikertelen feltöltés";
                    }
                    
                }
                    
               
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <label for="datum">Dátum</label>
                    <input type="date" name="datum" id="datum" required>
                    <br>
                    <label for="rendeles_tipusa">Rendeles típusa</label>
                    <input type="text" name="rendeles_tipusa" id="rendeles_tipusa" required>
                    <br>
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
                   <label for="oid">Rendelő azonosító</label>
                    <select name='razon'>
                        <?php 
                        $asd;
                        $SQL2="SELECT `razon` FROM `rendelok`";
                        $lekerdezes=$kapcsolat->query($SQL2);
                        while($sor=$lekerdezes->fetch_assoc()){
                            echo '<option value="'.$sor['razon'].'">';  
                            echo $sor['razon'];
                            echo '</option>';
                        }
                       
                        ?>
                       
                    </select>
                   <script>
                   function asd(){
                   var jArray= <?php echo json_encode($sor); ?>;

    for(var i=0;i<12;i++){
        document.getElementById('asd').value=jArray[i];
           document.getElementById("asd").innerHTML="jArray[i]";
        alert(jArray[i]);
    }
    }

                   
                   </script>
                   
                    
                    <br>
                    <label for="oraszam">Óra szám:</label>
                    <input type="number" name="oraszam" id="oraszam" required>
                    <br>
                    <input type="image" src="kepek/kuld.png" alt="elküld" height="20" width="20" name="ujkuld" id="ujkuld" value="ujkuld">
                    <br>
                </form>
                
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
