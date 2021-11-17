<html>
    <head>
        <meta charset="UTF-8">
        <title>Prijestupne godine</title>
    </head>
    <body>
    <?php
    /*Ispitati i ispisati prijestupne godine između 1979. i 2037.*/
    $godina1=1979;
    $godina2=2037;
    
    for($godina1;$godina1<$godina2;++$godina1){
        $leap=date("L",mktime(0, 0, 0, 1, 13, $godina1));
         if($leap=="1"){
            echo date("Y",mktime(0, 0, 0, 1, 13, $godina1))."<br>";
            }
        }
    ?>
    </body>
</html>

