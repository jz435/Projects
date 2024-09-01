<html>
<body>

<head> <link rel="stylesheet" href="phpstyling.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet"> </head>

<h1>Schematjänst</h1>

<form method='POST' action='programsvar.php'>
<?php
 
    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/programs/?mode=xml');
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);


echo "Välj ditt program: ";

echo "<select name='program'>";
    
    $programs= $dom->getElementsByTagName('program');
    foreach ($programs as $program){
        echo"<option value='" .$program->getAttribute("id")."'>";
        echo $program->getAttribute("name");
        echo "</option>";
    }

echo "</select>";

  
?>
<button>Submit!</button>
</form>





<form method='POST' action='staffsvar.php'>
<?php
 
    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/staff/?mode=xml');
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

echo "Välj lärare: ";
    
echo "<select name='staff'>";
    
    $stafflist= $dom->getElementsByTagName('staff');
    foreach ($stafflist as $staff){
        echo"<option value='" .$staff->getAttribute("id")."'>";
        echo $staff->getAttribute("id");
        echo " ". "-". " ";
        echo $staff->getAttribute("fname");
        echo " ";
        echo $staff->getAttribute("lname");
        echo "</option>";
    }

echo "</select>";

  
?>
<button>Submit!</button>
</form>




<form method='POST' action='roomsvar.php'>
<?php
 
    $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/?mode=xml');
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

echo "Välj rum: ";
    
echo "<select name='room'>";
    
    $rooms= $dom->getElementsByTagName('room');
    foreach ($rooms as $room){
        echo"<option value='" .$room->getAttribute("number")."'>";
        echo $room->getAttribute("number");
        echo "</option>";
    }

echo "</select>";

  
?>
<button>Submit!</button>
</form>


<form method='POST' action='programsearch.php'>

    
<p class="fritext"><h2>Eller sök på ditt program i fritext: </h2> </p>  <input type='text'  placeholder = 'Sök på ditt program...' name='programsearch' />
      
    <button>Submit!</button>
    
</form>



  </body>
</html>