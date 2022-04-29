<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Podaci o skoli prema odabiru</title>
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Odaberite tip škole: <select name="ov1" id="ov1" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Strukovna</option>
            <option value="2">Gimnazija i strukovna</option>
            <option value="3">Gimnazija</option>
            <option value="4">Umjetnicka</option>
            <option value="5">Obrazovanje odraslih</option>
        </select> <br />
        Odaberite vrstu škole: <select name="ov2" id="ov2" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Redovna</option>
            <option value="2">Privatna</option>
            <option value="3">Vjerska</option>
            <option value="4">Obrazovanje odraslih</option>
            <option value="5">Skola za ucenike s teskocama</option>
            <option value="6">Ustanova socijalne skrbi</option>
        </select> <br />
        Odaberite četvrt škole: <select name="ov3" id="ov3" style="width: 150px !important; min-width: 150px; max-width: 150px;">
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
            <input type="submit" name="search" value="Traži"/>
            <input type="submit" name="button" value="Povratak"/>
        </div>
      </form>
        <?php
        if (isset($_POST['search'])){
             $tip = $_POST['ov1'];
             $vrsta = $_POST['ov2'];
             $cetvrt = $_POST['ov3'];
            
            if (($tip == "0") && ($vrsta == "0") && ($cetvrt == "0")){
                echo "Odabir nije valjan!";
            }
            else{
                
                ob_start();
                require('fpdf.php');
                class SrednjePDF extends FPDF
                {
                    function header(){
                        global $naslov;
                        $this->setFont("Times", 'B', 14);
                        $this->setDrawColor(20, 100, 50);
                        $this->setFillColor(10, 120, 150);
                        $this->setTextColor(255, 255, 255);
                        $this->setLineWidth(1);
                        $sirina = $this->getStringWidth($naslov) + 150;
                        $this->cell($sirina, 9, $naslov, 1, 1, 'C', 1);
                        $this->ln(10);
                    }
                    function footer(){
                        $this->setY(-15);
                        $this->setFont("Arial", 'BI', 8);
                        $this->cell(0, 10,
                        "Stranica {$this->pageNo()}/{nb}", 0, 0, 'C');
                    }
                }
                $naslov = "Srednje skole Zagreb";
                $pdf = new SrednjePDF('P', 'mm', 'Letter');
                $pdf->aliasNbPages();
                $pdf->addPage();
                $pdf->setFont("Times", '', 12);
                $pdf->cell(0, 0, "Podaci o skoli prema odabranim kriterijima: ", 0, 0,'L');
                $upit = "SELECT * FROM ((Skola S INNER JOIN Tip T on S.tipID=T.tipID) INNER JOIN Vrsta V on S.vrstaID=V.vrstaID) INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivTipa='$tip' OR nazivVrste='$vrsta' OR nazivCetvrti='$cetvrt'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
           
        }
        
        if (isset($_POST['button'])){
            header("Location: Izvjestaji.php");
        }
        ?>
    </body>
</html>

