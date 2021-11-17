<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Broj skola po vrsti</title>
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Odaberite vrstu škole: <select name="ov" id="ov" style="width: 150px !important; min-width: 150px; max-width: 150px;">
            <option value="0"></option>
            <option value="1">Redovna</option>
            <option value="2">Privatna</option>
            <option value="3">Vjerska</option>
            <option value="4">Obrazovanje odraslih</option>
            <option value="5">Skola za ucenike s teskocama</option>
            <option value="6">Ustanova socijalne skrbi</option>
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "6"){
                
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
                $pdf->cell(0, 0, "Broj skola po vrsti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Vrsta V on S.vrstaID=V.vrstaID WHERE nazivVrste='$odabir'";
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
