<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAX</title>
</head>          
<body>          
<form method="POST" action="saxresponses.php">

<?php

echo "<select name='NEWSPAPER'>";
echo "<option value='Morning_Edition'> Choose an option </option>";
    $output=false; 
    function startElement($parser, $entityname, $attributes) {
        if($entityname=="NEWSPAPER"){
        echo "<option value='".$attributes['TYPE']."'>";
        echo $attributes['NAME'];
        }
}
function endElement($parser, $entityname) {
    if($entityname=="NEWSPAPER"){
    echo "</option>";
    }
}

function charData($parser, $chardata) {
}

$parser = xml_parser_create();
xml_set_element_handler($parser, "startElement", "endElement");
xml_set_character_data_handler($parser, "charData");

$url="http://wwwlab.webug.se/examples/XML/articleservice/papers/";
$data = file_get_contents($url);

if(!xml_parse($parser, $data, true)){
printf("<P> Error %s at line %d</P>", xml_error_string(xml_get_error_code($parser)),xml_get_current_line_number($parser));
}else{
print "<br>Parsing Complete!</br>";
}

xml_parser_free($parser);
echo "</select>";

?> 

<input type="submit" value = 'SUBMIT'>   
</form>          
</body>         
</html>  