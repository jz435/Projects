<html>
<body>
<head> <link rel="stylesheet" href="phpstyling.css" /> </head>

<div style='width:100%;padding:10px;margin:10px;'>
<button onclick="history.back()">Gå Tillbaka</button>
<table>
<?php
 
    if(isset($_POST['program'])){
        $program=$_POST['program'];
    }else{
        $program="Unknown";
    }

    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/programs?id='.$program);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $xml2 = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/?mode=xml');
    $dom2 = new DomDocument;
    $dom2->preserveWhiteSpace = FALSE;
    $dom2->loadXML($xml2);

    
    
    
    $programs = $dom->getElementsByTagName('program');
    foreach ($programs as $program){
        echo "<table style='width:50%;'>";       
        echo "<tr>";
            $program_attributer = $program->attributes;
            foreach ($program_attributer as $main=>$attr){
                
                
                echo "<td>".$attr->nodeName.": "."<h3>". $attr->value."</h3>";
                
            }
        echo "</td>";
        echo "</tr>"; 
        echo "</table>";   
        
        
        
        $entry = $dom->getElementsByTagName('entries');
            foreach($entry as $entries){   
            echo "<table style='width:50%;'>";            
            echo "<tr>";
                $entries_attributer = $entries->attributes;
                    foreach($entries_attributer as $E=>$A){
                        echo "<td>". $A->nodeName.": "."<h3>". $A->value."</h3>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    

                      
                    $compare = $dom2->getElementsByTagName('entry');

            foreach($compare as $compares){
                if($compares->getAttribute("courseid")==$entries->getAttribute("id")){   
                            
                echo "<tr>";
                    $compares_attributer = $compares->attributes;
                        foreach($compares_attributer as $E=>$A){

                            echo "<td style ='margin: 15px;'>". $A->nodeName.": ". $A->value. "</td>"."</h2>";
                        }
                        echo "</tr>";
                        
                }
                
            }
            echo "</table>";
        }

            

            

           
    }

    
  
?>



</table>
</div>
</body>
</html>