<html>
    <head>
        <meta charset="UTF-8">
        <title>Prikaz podataka narudzba</title>
    </head>
    <body>
        <div style="text-align: center;">
            <h1>Narudžba</h1>
            <table border="1" cellpadding="2" cellspacing="2" style="width:60%; margin-left: auto; margin-right: auto;">
                <tr>
                    <th>Narudžba ID</th>
                    <th>Ime i prezime</th>
                    <th>E-mail</th>
                    <th>Adresa</th>
                    <th>OIB</th>
                    <th>Odabir paketa</th>
                    <th>Napomena</th>
                </tr>
        <?php
           $baza = mysqli_connect('localhost','root','') or die ('Nije moguće uspostaviti vezu.');
           mysqli_select_db($baza, 'Web_Forma') or die (mysqli_error($baza));
            
           $sql= "SELECT * FROM Narudzba";
                
           mysqli_query($baza, $sql) or die (mysqli_error($baza));
           $result = $baza->query($sql);
           
           $brojuno=0;
           if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["narudzbaID"] . '</td>';
                        echo '<td>' . $row["imeIprezime"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["adresa"] . '</td>';
                        echo '<td>' . $row["oib"] . '</td>';
                        echo '<td>' . $row["odabirPaketa"] . '</td>';
                        echo '<td>' . $row["napomena"] . '</td>';           
                        echo '<tr>';
                        $brojuno++;
                    }
                } else {
                        echo "Nema podataka u tablici!";
                }
           $baza->close();
        ?>
            </table>
            <p><?php echo "Broj unosa:" . $brojuno; ?></p>
            <a href="Podaci_Narudzba.html"> <input type="submit" value="Nazad"/></a>
        </div>
    </body>
</html>

