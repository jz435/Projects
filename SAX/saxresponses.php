<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAX</title>
</head>
<body>
<table border='1'>  
    <?php
       $lastelement="";
        if(isset($_POST['NEWSPAPER'])){
            $edition=$_POST['NEWSPAPER'];
            }
            else{
            $edition="Morning_Edition";
            }

            function startElement($parser, $entityname, $attributes) {
            global $lastelement;
            if($entityname=="NEWSPAPER"){
                echo "<tr>";
                echo "<td>";
                echo "<h2 style='font-size: 30px;'>".$attributes['NAME']."</td>"; 
                echo "<td>Subscribers: ".$attributes['SUBSCRIBERS']."</td>";
                echo "<td>Edition: ".$attributes['TYPE']."</td>";
                echo "<td><table border='1'>";  
                }

        if($entityname=="ARTICLE"){
            if ($attributes ['DESCRIPTION'] =="News"){
                    echo "<tr style='background:#484a26;'>"; 
                }

                else {
                    echo "<tr style='background:#264a46;'>"; 
                }

                echo "<td>";
                echo $attributes['ID'];
                echo $attributes['TIME'];
                echo $attributes['DESCRIPTION'];
                echo "<div>";
                }

        if ($entityname =="HEADING"){
            echo "<h3 style='font-family:verdana'>";
            echo "<i>";
        }

        if ($entityname =="STORY"){
            echo "<div style='border: 2px solid;' >";
        }

        if ($entityname =="TEXT" && $lastelement=="STORY"){
            echo "<p style='font-family:verdana'>";
        }

        if ($entityname!="TEXT"){
            $lastelement=$entityname;
            }
    }

function endElement($parser, $entityname) {
    global $lastelement;
    if($entityname=="NEWSPAPER"){
        echo "</table></td>";
        echo "</tr>";
    }

    if($entityname=="ARTICLE"){
        echo "</td></tr>";
        echo "</div>";
    }

    if ($entityname =="HEADING"){
        echo "</h3>";
        echo "</i>";
    }

    if ($entityname =="STORY"){
        echo "</div>";
    }

    if ($entityname =="TEXT" && $lastelement=="STORY"){
        echo "</p>";
        }
}

function charData($parser, $chardata) {
    global $lastelement;
    echo $chardata;
    $chardata=trim($chardata);
    }


$parser = xml_parser_create();
xml_set_element_handler($parser, "startElement", "endElement");
xml_set_character_data_handler($parser, "charData");

$url="http://wwwlab.webug.se/examples/XML/articleservice/articles?paper=".$edition;
$data = file_get_contents($url);

if(!xml_parse($parser, $data, true)){
printf("<P> Error %s at line %d</P>", xml_error_string(xml_get_error_code($parser)),xml_get_current_line_number($parser));
}else{
print "<br>Parsing Complete!</br>";
}
xml_parser_free($parser);

    ?>

</table>       
</body>             
<html> 