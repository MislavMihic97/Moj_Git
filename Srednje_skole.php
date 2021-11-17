<?php
  session_start(); 
?> 

<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Srednje škole</title>
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Unesite ID škole: <input type="text" name="skolaID" /><br />
        Unesite naziv škole: <input type="text" name="naziv" /><br />
        Unesite adresu škole: <input type="text" name="adresa" /><br />
        Odaberite tip škole: <select name="tip" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Strukovna</option>
            <option value="2">Gimnazija i strukovna</option>
            <option value="3">Gimnazija</option>
            <option value="4">Umjetnicka</option>
            <option value="5">Obrazovanje odraslih</option>
        </select> <br />
        Odaberite vrstu škole: <select name="vrsta" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Redovna</option>
            <option value="2">Privatna</option>
            <option value="3">Vjerska</option>
            <option value="4">Obrazovanje odraslih</option>
            <option value="5">Skola za ucenike s teskocama</option>
            <option value="6">Ustanova socijalne skrbi</option>
        </select> <br />
        Odaberite četvrt škole: <select name="cetvrt" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Crnomerec</option>
            <option value="2">Donji Grad</option>
            <option value="3">Gornja Dubrava</option>
            <option value="4">Gornji Grad-Medvescak</option>
            <option value="5">Maksimir</option>
            <option value="6">Novi Zagreb-Istok</option>
            <option value="7">Novi Zagreb-Zapad</option>
            <option value="8">Pescenica-Zitnjak</option>
            <option value="9">Podsljeme</option>
            <option value="10">Podsused-Vrapce</option>
            <option value="11">Sesvete</option>
            <option value="12">Stenjevec</option>
            <option value="13">Tresnjevka-Sjever</option>
            <option value="14">Trnje</option>
        </select> <br />
        <div> <br />
            <input type="submit" name="insert" value="Unesi"/>
            <input type="submit" name="update" value="Ažuriraj"/>
            <input type="submit" name="delete" value="Obriši"/>
            <input type="submit" name="search" value="Tražilica"/>
        </div>
      </form>
        <?php
        $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
        mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
        
        if (!empty($_POST['naziv']) && (!empty($_POST['adresa']))){ 
            $naziv_skole=$_POST['naziv'];
            $adresa_skole=$_POST['adresa'];
        
        function dohvatiPosts(){
            $posts = array();
            $posts[0] = $_POST['skolaID'];
            $posts[1] = $_POST['naziv'];
            $posts[2] = $_POST['adresa'];
            $posts[3] = $_POST['tip']; 
            $posts[4] = $_POST['vrsta'];
            $posts[5] = $_POST['cetvrt'];
            return $posts; 
        }
            
        if (isset($_POST['insert'])){
            $podaci = dohvatiPosts();
            if ((preg_match("[0-9]", $adresa_skole)==1) && (strlen($naziv_skole)>4)){
                $upitINS = "INSERT INTO Skola (skolaID, nazivSkole, adresaSkole, tipID, vrstaID, cetvrtID, zadnjaIzmjena) VALUES ('$podaci[0]', '$podaci[1]', '$podaci[2]', '$podaci[3]', '$podaci[4]', '$podaci[5]', 'date('d-m-Y H:i:s')')";
            
                try{
                    $rezultatINS = mysqli_query($baza, $upitINS);
                    
                    if($rezultatINS){
                        if(mysqli_affected_rows($baza)>0){
                            echo "Podaci su unešeni u tablicu!";
                        }
                        else{
                            echo "Podaci nisu unešeni u tablicu!";
                        }
                    }
                } catch (Exception $ex) {
                    echo "Pogreška pri unosu!" .$ex->getMessage();
                }
            }
            else {
                echo "Podaci su pogrešno unešeni!" ."<br>";
            }
        }
        
        if (isset($_POST['update'])){
            $podaci = dohvatiPosts();
            if ((preg_match("[0-9]", $adresa_skole)==1) && (strlen($naziv_skole)>4)){
                $upitUPD = "UPDATE Skola SET nazivSkole='$podaci[1]', adresaSkole='$podaci[2]', zadnjaIzmjena='date('d-m-Y H:i:s')' WHERE skolaID = $podaci[0]";
            
                try{
                    $rezultatUPD = mysqli_query($baza, $upitUPD);
                    
                    if($rezultatUPD){
                        if(mysqli_affected_rows($baza)>0){
                            echo "Podaci su ažurirani u tablici!";
                        }
                        else{
                            echo "Podaci nisu ažurirani u tablici!";
                        }
                    }
                } catch (Exception $ex) {
                    echo "Pogreška pri ažuriranju!" .$ex->getMessage();
                }
            }
            else {
                echo "Podaci su pogrešno unešeni!" ."<br>";
            }
        }
        
        if (isset($_POST['delete'])){
            $podaci = dohvatiPosts();
            if (strlen($naziv_skole)>4){
                $upitDEL = "INSERT INTO Arhiva SELECT * FROM Skola WHERE nazivSkole = '$podaci[1]'";
                $upitDEL .= "DELETE * FROM Skola WHERE nazivSkole = '$podaci[1]'";
            
                if (!$baza->multi_query($upitDEL)){
                    echo "Pogreška: (" . $baza->errno . ") " . $baza->error;
                }
                else{
                    echo "Podaci su izbrisani iz tablice i stavljeni u arhivu!";
                }
            }
            else {
                echo "Podaci su pogrešno unešeni!" ."<br>";
            }
        } 
        }
        
        if (isset($_POST['search'])){
                include 'Izvjestaji.php';
        }
        
        ?>
        
        <?php
        if (!isset($_SESSION['ime'])){ 
        
        $_SESSION['ime'] = "korisnik";
        $_SESSION['pocetak'] = time();

        echo "Dobro došao, korisniče! " . " Stvorena je nova sjednica <br>";
        echo "Klikni <a href=" . $_SERVER['PHP_SELF'];
        echo ">ovdje</a> za osvježavanje stranice.<br>";}
        
        else if (isset($_SESSION['ime'])) { 
            echo "Ova sjednica je započeta prije " ;
            echo round((time() - $_SESSION['pocetak']) ) . " sekundi. <br>"; 
            echo "Klikni <a href=".$_SERVER['PHP_SELF'];
            echo ">ovdje</a> za osvježavanje stranice.<br>";}
        ?>
    </body>
</html>

