<html>
<body>
<head> <link rel="stylesheet" href="phpstyling.css" /> </head>
<div style='width:100%px;padding:10px;margin:10px;'>
<table>
<?php
 
    // Assign country variable - Sweden is default
    if(isset($_POST['programsearch'])){
        $programsearch=$_POST['programsearch'];
    }else{
        $programsearch="Unknown";
    }
  
    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/programs?namesearch='.urlencode($programsearch));
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $xml2 = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/?mode=xml');
    $dom2 = new DomDocument;
    $dom2->preserveWhiteSpace = FALSE;
    $dom2->loadXML($xml2);

    $programsearch2 = $dom->getElementsByTagName('program');
    foreach ($programsearch2 as $program){

        echo "<tr>";
            $program_attributer = $program->attributes;
            foreach ($program_attributer as $main=>$attr){
                
                echo "<td style ='margin: 15px;' >". "<h2>". $attr->nodeName.": ". $attr->value. "</td>"."</h2>";
                
                
            }
            
        echo "</tr>";



        $kurs = $dom2->getElementsByTagName('entry');
        
            foreach($kurs as $entries){  
                
                if($entries->getAttribute("coursename") == $programsearch) {            
                echo "<tr>";
                $entries_attributer = $entries->attributes;
                    foreach($entries_attributer as $E=>$A){
                        echo "<td style ='margin: 15px;'>". $A->nodeName.": ". $A->value. "</td>"."</h2>";
                    }
                    echo "</tr>";
                }
        }
     }
    

        
    
?>
<button onclick="history.back()">Gå Tillbaka</button>
</table>
</div>
</body>
</html>