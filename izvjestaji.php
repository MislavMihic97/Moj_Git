<html>
    <meta charset="UTF-8">
    <title>Izvjestaji</title>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <div> <br />
                <a href="Izvjestaj_tip.php">Broj skola po tipu</a> <br/>
                <a href="Izvjestaj_vrsta.php">Broj skola po vrsti</a> <br/>
                <a href="Izvjestaj_cetvrt.php">Broj skola po cetvrti</a> <br/>
                <a href="Izvjestaj_podaci.php">Podaci o skoli prema odabiru</a> <br/>
                <input type="submit" name="button" value="Povratak"/>
            </div>
        </form>
        <?php
        if (isset($_POST['button'])){
            header("Location: Srednje_skole.php");
        }
        ?>
    </body>
</html>
