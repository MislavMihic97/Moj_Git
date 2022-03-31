<html>
    <head>
        <meta charset="UTF-8">
        <title>Unos podataka u narudžbu</title>
    </head>
    <body>
        <?php
                $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
                mysqli_select_db($baza, 'Web_Forma') or die (mysqli_error($baza));
            
                $imeprezime = $_POST['imeprezime'];
                $email = $_POST['email'];
                $adresa = $_POST['adresa'];
                $oib = $_POST['oib'];
                $odabirpaketa = $_POST['odabirpaketa'];
                $napomena = $_POST['napomena'];
                
                $sql = "INSERT INTO Narudzba (imeIprezime, email, adresa, oib, odabirPaketa, napomena) VALUES ('$imeprezime', '$email', '$adresa', '$oib', '$odabirpaketa', '$napomena')";
                
                if(mysqli_query($baza, $sql)){
                    echo "Podaci su uspješno unenešeni.";
                } 
                else{
                    echo "Pogreška! " 
                      . mysqli_error($baza);
                }
                
                $baza->close();
        ?>
    <center>
        <a href="Narudzba.html"> <input type="submit" value="Nazad"/></a>
    </center>
    </body>
</html>
