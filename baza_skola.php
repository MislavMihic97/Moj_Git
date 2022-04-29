<?php
    $host = 'localhost';
    $korisnik = 'root';
    $sifra = '';
    $baza = mysqli_connect($host,$korisnik,$sifra) or die ('Nije moguće uspostaviti vezu.');
    $upit = 'CREATE DATABASE IF NOT EXISTS Srednje_skole_Zagreb CHARACTER SET=utf8 COLLATE utf8_croatian_ci';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
    $upit = 'CREATE TABLE Vrsta (
    vrstaID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivVrste VARCHAR(60) NOT NULL,
    PRIMARY KEY (vrstaID)
    )
    ENGINE = MyISAM';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));
    
    $upit = 'CREATE TABLE Tip (
    tipID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivTipa VARCHAR(60) NOT NULL,
    PRIMARY KEY (tipID)
    ) ENGINE = MyISAM';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));
    
    $upit = 'CREATE TABLE Cetvrt (
    cetvrtID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivCetvrti VARCHAR(60) NOT NULL,
    PRIMARY KEY (cetvrtID)
    ) ENGINE = MyISAM';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));
    
    $upit = 'CREATE TABLE Skola (
    skolaID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nazivSkole VARCHAR (60) NOT NULL,
    adresaSkole VARCHAR (60) NOT NULL,
    vrstaID INTEGER UNSIGNED,
    tipID INTEGER UNSIGNED,
    cetvrtID INTEGER UNSIGNED,
    zadnjaIzmjena DATE,
    PRIMARY KEY (skolaID)
    ) ENGINE = MyISAM';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));
    
    $upit = 'CREATE TABLE Arhiva (
    arhivaID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    skolaID INTEGER UNSIGNED,
    nazivSkoleArh VARCHAR (60) NOT NULL,
    adresaSkoleArh VARCHAR (60) NOT NULL,
    tipID INTEGER UNSIGNED,
    vrstaID INTEGER UNSIGNED,
    cetvrtID INTEGER UNSIGNED,
    PRIMARY KEY (arhivaID)
    ) ENGINE = MyISAM';
    mysqli_query($baza, $upit) or die (mysqli_error($baza));     
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Stvaranaje baze</title>
    </head>
    <body>
    <?php
    echo "Baza stvorena!";
    ?>
    </body>
</html>

