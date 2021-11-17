<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Broj skola po cetvrti</title>
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Odaberite četvrt škole: <select name="ov" id="ov" style="width: 150px !important; min-width: 150px; max-width: 150px;">
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "7"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "8"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "9"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "10"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "11"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "12"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');$upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "13"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
                $rezultat = mysqli_query($baza, $upit);
                while ($row = mysqli_fetch_array($rezultat)){
                    $pdf->cell(0, 0, "", 0, 0,'L');
                }
                $pdf->ln(225);
                $pdf->output();
                ob_flush();
            }
            
            if ($odabir == "14"){
                
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
                $pdf->cell(0, 0, "Broj skola po cetvrti: ", 0, 0,'L');
                $upit = "SELECT COUNT(*) FROM Skola S INNER JOIN Cetvrt C on S.cetvrtID=C.cetvrtID WHERE nazivCetvrti='$odabir'";
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
