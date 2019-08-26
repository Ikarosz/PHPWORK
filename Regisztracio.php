<?php
include_once './kapcsolati adatok.php';
    include_once './kepadatok.php';     
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
                      <label for="fn">Felhasználónév </label>
            <input type="text" name="fn" id="fn"  required>
            <br>
            <label for="mail">E-mail</label>
            <input type="email" name="mail" id="mail"  required>
            <br>
            <label for="teljes">Teljes név</label>
            <input type="text" name="teljes" id="teljes"  >
            <br>
            
            <label for="jsz1">Jelszó1</label>
            <input type="password" name="jsz1" id="jsz1"  required>
            <br>
            <label for="jsz2">Jelszó2</label>
            <input type="password" name="jsz2" id="jsz2"  required>
            <br>
            <label for="kep">Kép</label>
             <input type="file" name="kep" id="kep" required>
            <br>

            <input type="submit" value="Regisztráció" name="reg" id="reg">
               
            
            <a href="Login.php"><img class="haz" src="kepek/haz.png" alt="haz"/> Login</a> 
                <?php
                
                
        // put your code here
        
              if(isset($_POST['reg'])){
           //adatok ellenörzése
            
            if(isset($_POST['fn'])){
                $felhasznalo=mysqli_real_escape_string($kapcsolat, trim($_POST['fn']));
               
            }
      
            
            
            if(isset($_POST['teljes'])){
               $teljes=mysqli_real_escape_string($kapcsolat, trim($_POST['teljes']));
                 
            }
           
             if(isset($_POST['mail'])){
                 $mail=mysqli_real_escape_string($kapcsolat, trim($_POST['mail']));
                 
            }
     
            
            
             if(isset($_POST['jsz1']) && isset($_POST['jsz2'])){
                 if($_POST['jsz1']==$_POST['jsz2'])
                 {
                     
                 
                $jelszo=mysqli_real_escape_string($kapcsolat, trim($_POST['jsz1']));
           
                $jelszo=md5($jelszo);
        
                
                 
                 }
                 else{
                     echo "A jelszavak nem egyeznek meg!<br>";
                 }
            }
            else {
                echo "Tölts ki a jelszó mezőket!<br>";
            }
            
            if(!empty($_FILES['kep']['name'])){
                $kep=$_FILES['kep']['name'];
               
            }
            else {
                echo "Adja meg a képet !<br>";
            }
            
                  $sql = "CREATE TABLE IF NOT EXISTS felhasznalok (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
felhaszname VARCHAR(30) NOT NULL,
jelszo int NOT NULL,
valodiname VARCHAR(30) NOT NULL,
profilimage BLOB,
email VARCHAR(50)
)";
 $tablakreal=$kapcsolat->query($sql) === TRUE;
 
            
            //ha mindent kötelezőt kitöltött az űrlapon
            if(isset($_POST['jsz1']) && isset($_POST['jsz2']) && isset($_POST['mail']) && isset($_POST['fn']) && $_FILES['kep']['error'] == 0 ){
                
                $hely =  KEPHELYE. $kep;
          if (move_uploaded_file($_FILES['kep']['tmp_name'], $hely)) {
                //adatbázisba mentés
                $SQL="INSERT INTO felhasznalok(felhaszname,jelszo,valodiname,profilimage,email ) VALUES ('" . $felhasznalo . "''" . $jelszo ."','" .$teljes."','".$kep."','".$mail."');";
                
                //
                
                //echo $SQL;
                 if ($kapcsolat->query($SQL) === TRUE) {
                     echo "Sikeres regisztráció.<br>";
                     echo '  <a href="login.php">Bejelentkezés</a>';
                 }
            }else
            {
                echo "Probléma fájl feltöltéskor";
            }
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

