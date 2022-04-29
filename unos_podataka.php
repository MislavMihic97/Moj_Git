<?php
    $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
    mysqli_select_db($baza, 'Srednje_skole_Zagreb') or die (mysqli_error($baza));
    
    if(isset($_POST['submit'])){
        if($_FILES['file']['name']){
            $file_name = basename($_FILES['file']['name']);
            $file = fopen($file_name, "r");
            fgetcsv($file);
            while (($getData = fgetcsv($file, 1000, ';')) !== FALSE) { //DUPLIKATI U UNOSU??
                
                $naziv = $getData[0];
                $adresa = $getData[1];
                $vrsta = $getData[2]; //[]
                $tip = $getData[4];
                $cetvrt = $getData[5];
                
                //$v1[] = array_unique($vrsta);
                $upit1 = "SELECT * FROM Vrsta";
                $test1 = mysqli_query($baza, $upit1);
            
                if($test1 === false || $test1->num_rows < 1){
                        $upit2 = "SELECT nazivVrste FROM Vrsta";
                        $test2 = mysqli_query($baza, $upit2);
                        if($test2->num_rows < 1){
                            $upit = "INSERT INTO Vrsta (nazivVrste) VALUES ('$vrsta')";
                            mysqli_query($baza, $upit);
                        }
                        /*else{
                            echo "Greška 2!";
                        }*/
                }
                /*else{
                    echo "Greška 1!";
                }*/
                if($test1 === true || $test1->num_rows > 0){
                        //DB: 
                        $upit3 = "SELECT COUNT(*) FROM Vrsta WHERE nazivVrste='" . $vrsta . "'";
                        $test3 = mysqli_query($baza, $upit3); //tu javlja da je vrijednost rezultata NULL
                        /*$upit2 = "SELECT nazivVrste FROM Vrsta";
                        $test2 = mysqli_query($baza, $upit2);*/
                        //while($row = $test2->fetch_assoc() != null) {
                            //for($i = 0; $i < 6; ++$i){
                                if(is_null($test3)){
                                    $upit = "INSERT INTO Vrsta (nazivVrste) VALUES ('$vrsta')";
                                    mysqli_query($baza, $upit);
                                }
                                /*else{
                                    echo "Greška 4!";
                                }
                            }*/
                        //}
                }
                /*else{
                    echo "Greška 3!";
                }*/
                /*
                $upit1 = "SELECT * FROM Tip";
                $test1 = mysqli_query($baza, $upit1);
            
                if($test1 === false || $test1->num_rows < 1){
                        $upit2 = "SELECT nazivTipa FROM Tip";
                        $test2 = mysqli_query($baza, $upit2);
                        if($test2->num_rows < 1){
                            $upit = "INSERT INTO Tip (nazivTipa) VALUES ('$tip')";
                            mysqli_query($baza, $upit);
                        }
                }
                if($test1 === true || $test1->num_rows > 0){
                            $upit3 = "SELECT COUNT(*) FROM Tip WHERE nazivTipa='" . $tip . "'";
                            $test3 = mysqli_query($baza, $upit3);
                            if($test3 == 0){ 
                                $upit = "INSERT INTO Tip (nazivTipa) VALUES ('$tip')";
                                mysqli_query($baza, $upit);
                            }
                }
                
                $upit1 = "SELECT * FROM Cetvrt";
                $test1 = mysqli_query($baza, $upit1);
            
                if($test1 === false || $test1->num_rows < 1){
                        $upit2 = "SELECT nazivCetvrti FROM Cetvrt";
                        $test2 = mysqli_query($baza, $upit2);
                        if($test2->num_rows < 1){
                            $upit = "INSERT INTO Cetvrt (nazivCetvrti) VALUES ('$cetvrt')";
                            mysqli_query($baza, $upit);
                        }
                }
                if($test1 === true || $test1->num_rows > 0){
                            $upit3 = "SELECT COUNT(*) FROM Cetvrt WHERE nazivCetvrti='" . $cetvrt . "'";
                            $test3 = mysqli_query($baza, $upit3);
                            if($test3 == 0){
                                $upit = "INSERT INTO Cetvrt (nazivCetvrti) VALUES ('$cetvrt')";
                                mysqli_query($baza, $upit);
                            }
                }
                
                $upit = "SELECT tipID FROM Tip WHERE nazivTipa='$tip'";
                $rezultat = mysqli_query($baza, $upit);
                $check = mysqli_num_rows($rezultat);
                
                if ($check > 0){
                    while ($row = mysqli_fetch_assoc($rezultat)){
                        $tipID = $row;
                    }
                }
                
                $upit = "SELECT vrstaID FROM Vrsta WHERE nazivVrste='$vrsta'";
                $rezultat = mysqli_query($baza, $upit);
                $check = mysqli_num_rows($rezultat);
                
                if ($check > 0){
                    while ($row = mysqli_fetch_assoc($rezultat)){
                        $vrstaID = $row;
                    }
                }
                
                $upit = "SELECT cetvrtID FROM Cetvrt WHERE nazivCetvrti='$cetvrt'";
                $rezultat = mysqli_query($baza, $upit);
                $check = mysqli_num_rows($rezultat);
                
                if ($check > 0){
                    while ($row = mysqli_fetch_assoc($rezultat)){
                        $cetvrtID = $row;
                    }
                }
                
                $upit = "INSERT INTO Skola (nazivSkole, adresaSkole, vrstaID, tipID, cetvrtID) VALUES ('$naziv', '$adresa', '$vrstaID', '$tipID', '$cetvrtID')";
                mysqli_query($baza, $upit);
                */
                }
                fclose($file);
                
                echo "Import done!";
        }
    }  
?>

<html>
    <meta charset="UTF-8">
    <title>Upload file</title>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <div align="center">
                <p>Upload File: <input type="file" name="file" /></p>
                <p><input type="submit" name="submit" value="Import"</p>
            </div>
    </body>
</html>
