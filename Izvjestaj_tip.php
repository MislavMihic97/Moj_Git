<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Broj skola po tipu</title>
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Odaberite tip škole: <select name="ov" id="ov" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Strukovna</option>
            <option value="2">Gimnazija i strukovna</option>
            <option value="3">Gimnazija</option>
            <option value="4">Umjetnicka</option>
            <option value="5">Obrazovanje odraslih</option>
        </select> <br />
        <div> <br />
            <input type="submit" name="search" value="Traži"/>
            <input type="submit" name="button" value="Povratak"/>
        </div>
      </form>
        <?php
        if (isset($_POST['search'])){
            $odabir = $_POST['ov'];
            
            if ($odabir == "0"){
                echo "Odabir nije valjan!";
            }
            
            if ($odabir == "1"){
                
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
                $pdf->cell(0, 0, "Broj skola po tipu: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Tip T on S.tipID=T.tipID WHERE nazivTipa='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "2"){
         
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
                $pdf->cell(0, 0, "Broj skola po tipu: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Tip T on S.tipID=T.tipID WHERE nazivTipa='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "3"){
               
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
                $pdf->cell(0, 0, "Broj skola po tipu: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Tip T on S.tipID=T.tipID WHERE nazivTipa='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "4"){
                
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
                $pdf->cell(0, 0, "Broj skola po tipu: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Tip T on S.tipID=T.tipID WHERE nazivTipa='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "5"){
                
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
                $pdf->cell(0, 0, "Broj skola po tipu: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Tip T on S.tipID=T.tipID WHERE nazivTipa='$odabir'";
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

