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
          
            </div>
            <div id="bal">
 <form action=""<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="login">Login</label>
                    <br>
                    <input type="text" id="login" name="login">
                         <br>
              <label for="pas">Jelszo</label>
                     <br>
                    <input type="password" id="pas" name="pas">
                      <br>
                        <br>
                     <input type="submit" value="log In" name="sub" id="sub">
               
                     <a href="Regisztracio.php"><img class="haz" src="kepek/haz.png" alt="haz"/> Regisztráció</a> 
                <?php
                    
               
                if(isset($_POST['login']) && isset($_POST['pas'])){
                    
                             $li= mysqli_real_escape_string($kapcsolat, trim($_POST['login']));
            $jsz = md5(mysqli_real_escape_string($kapcsolat, trim($_POST['pas'])));
                

                $sql = "CREATE TABLE IF NOT EXISTS felhasznalok (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
felhaszname VARCHAR(30) NOT NULL,
jelszo int NOT NULL,
valodiname VARCHAR(30) NOT NULL,
profilimage BLOB,
email VARCHAR(50)
)";
 $tablakreal=$kapcsolat->query($sql) === TRUE;
 
 
 
  $SQL1 = "SELECT * FROM felhasznalok WHERE felhaszname = '$li' AND jelszo = '$jsz'";
            //echo $SQL1;
            $adat = $kapcsolat->query($SQL1) or die("Hiba az adatok lekérésekor!");
            
            
             if ($adat->num_rows >0) {
                $row = $adat->fetch_assoc();
               
                $_SESSION['login'] = $row['felhaszname'];
                
                setcookie('nev', $row['felhaszname'], time() + (60 * 60 * 24 * 30));  // érvényesség: 30 nap
                
     echo '<div id="bal">'.$_SESSION['login'].'</div><br>';
            //echo '<img src="'.KEPHELYE.$row['kep'].'">';
            echo $row['felhaszname'].", ".$row['$teljes'].", ".$row['email'].".<br> ";
            echo '<a href="Logout.php">Kijelentkezés</a>';
             }
            
                }
 
   
                
                ?>
                     
                     
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

