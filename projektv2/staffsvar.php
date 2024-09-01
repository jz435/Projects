<html>
<head> <link rel="stylesheet" href="phpstyling.css" /> </head>
<body>

<button onclick="history.back()">Gå Tillbaka</button>
<table>
<?php
 
    if(isset($_POST['staff'])){
        $staff=$_POST['staff'];
    }else{
        $staff="Unknown";
    }

    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/staff?id='.$staff);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $xml2 = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/courses/?mode=xml');
    $dom2 = new DomDocument;
    $dom2->preserveWhiteSpace = FALSE;
    $dom2->loadXML($xml2);
    
    $staff = $dom->getElementsByTagName('staff');
    foreach ($staff as $staffs){
        echo "<table>";
        echo "<tr>";
        echo "<td>";
        echo "ID: ".$staffs->getAttribute("id")."<br>"." ";
        echo "Namn: ".$staffs->getAttribute("fname")." ". $staffs->getAttribute("lname")."<br>"." ";
        echo "Titel: ".$staffs->getAttribute("title")."<br>"." ";
        echo "Avdelning: ".$staffs->getAttribute("department")."<br>"." ";
        echo "Kontakt: ".$staffs->getAttribute("telnr")."<br>"." ";
        echo "Födelseår: ".$staffs->getAttribute("birthyear")."<br>"." ";
        echo "</tr>";
        echo "</td>";
        echo "</table>";

        
        $entry = $dom2->getElementsByTagName('entries');
        echo "<table>";
            foreach($entry as $entries){
                
            $teachers = explode(',',$entries->getAttribute("sign"));
            if($teachers[0] == $staffs->getAttribute("id") || $teachers[1] == $staffs->getAttribute("id")){     
                echo "<td>";
                
                echo "<a href='roomsvar.php?val=".$entries->getAttribute("room")."'>".$entries->getAttribute("room")."</a>"; 
                echo "<br>";
                echo "Starttid: ".$entries->getAttribute("starttime");
                echo " - ".$entries->getAttribute("endtime");
                echo "<br>";
                echo $entries->getAttribute("sign");
                echo "<br>";
                echo $entries->getAttribute("comment"); 
                echo "</tr>";
                echo "</td>";
                
            }
            
         }

         echo "</table>";
        



    }
    
?>


</table>
