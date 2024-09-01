<html>
<body>
<head> <link rel="stylesheet" href="phpstyling.css" /> </head>
<div style='width:100%;padding:10px;margin:10px;'>
<table>
<?php
 
    if(isset($_POST['room'])){
    $room=$_POST['room'];
    }else if(isset($_GET['val'])){
        $room=$_GET['val'];     
    }

    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/?number='.$room);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);
    
    $room = $dom->getElementsByTagName('room');
    foreach ($room as $rooms){

        echo "<tr>";
            $room_attributer = $rooms->attributes;
            foreach ($room_attributer as $main=>$attr){
                
                echo "<td style ='margin: 15px;'>". "<h2>". $attr->value.": "."</h2>"."</td>";
                
            }
        echo "</tr>";

        
        $entry = $dom->getElementsByTagName('entry');


            foreach($entry as $entries){
            echo "<tr>";
                $entries_attributer = $entries->attributes;
                    foreach($entries_attributer as $E=>$A){
                        echo "<td style ='margin: 20px;'>".$A->nodeName.": ". $A->value. "</td>"."</h2>";
                    }
                    echo "</tr>";
            }

        



    }
  
?>

<button onclick="history.back()">Gå Tillbaka</button>
</table>
</div>