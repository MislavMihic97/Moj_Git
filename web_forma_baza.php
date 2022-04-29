<html>
    <head>
        <meta charset="UTF-8">
        <title>Web Forma Baza</title>
    </head>
    <body>
    <?php
        $host = 'localhost';
        $korisnik = 'root';
        $sifra = '';
        $baza = mysqli_connect($host,$korisnik,$sifra) or die ('Nije moguće uspostaviti vezu.');
        $upit = 'CREATE DATABASE IF NOT EXISTS Web_Forma CHARACTER SET=utf8 COLLATE utf8_croatian_ci';
        mysqli_query($baza, $upit) or die (mysqli_error($baza));
        mysqli_select_db($baza, 'Web_Forma') or die (mysqli_error($baza));
        
        $upit2 = 'CREATE TABLE OpcenitiUpit (
        upitID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        imeIprezime VARCHAR(60) NOT NULL,
        email VARCHAR(60) NOT NULL,
        upit VARCHAR(255) NOT NULL,
        PRIMARY KEY (upitID)
        )
        ENGINE = MyISAM';
        mysqli_query($baza, $upit2) or die (mysqli_error($baza));
    
        $upit3 = 'CREATE TABLE Narudzba (
        narudzbaID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        imeIprezime VARCHAR(60) NOT NULL,
        email VARCHAR(60) NOT NULL,
        adresa VARCHAR(60) NOT NULL,
        oib VARCHAR(15) NOT NULL,
        odabirPaketa VARCHAR(60) NOT NULL,
        napomena VARCHAR(255) NOT NULL,
        PRIMARY KEY (narudzbaID)
        )
        ENGINE = MyISAM';
        mysqli_query($baza, $upit3) or die (mysqli_error($baza));
        
        echo "Baza je stvorena!";
        $baza->close();
    ?>
    </body>
</html>
