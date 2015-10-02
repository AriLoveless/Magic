<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results</title>

<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="../styles/main.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
  <header id = "top">
    <h1>&nbsp;</h1>
    <nav id = "mainnav">
      <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="search.html">Search</a></li>
      <li>        <a href="insert.php">Insert New Card</a>      </li>
      <li><a href="Browse.html">Browse</a></li>
      <li><a href="invent.php">Inventory List</a></li>
    </ul> 
</nav>
   </header>
     <div id="hero">
    
    <article><?php

//name
$name1=$_POST['name'];
if(!$name1) {$name="";}
else {$name="CardName LIKE '%" .$name1. "%'"; }


//this checks if a checkbox is checked

function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            foreach($_POST[$chkname] as $chkval)
            {
                if($chkval == $value)
                {
                    return true;
                }
            }
        }
        return false;
    }

//if nothing is checked, no color criteria in sql
if (empty($_POST['Colors'])) { $color1 ="asdf"; $color = "";}

//otherwise start list for sql IN
else { $color1 = " Colors IN ("; 

//if a color is selected, add it to list
if (IsChecked('Colors', 'Uncolored')) { $color1 .= " 'null',"; }
if (IsChecked('Colors', 'Red')) {$color1 .= " 'red',"; }
if (IsChecked('Colors', 'Blue')){ $color1 .= " 'blue',";} //IsChecked('Colors', 'Colors_0')) { $color1 += " 'blue',"; }
if (IsChecked('Colors', 'Green')) { $color1 .= " 'green',"; }
if (IsChecked('Colors', 'Black')) { $color1 .= " 'black',"; }
if (IsChecked('Colors', 'White')) { $color1 .= " 'white',"; }

//echo "color1: " .$color1. "<br/>";
//echo IsChecked('Colors', 'Colors_0');

$color = rtrim($color1, ",");

//close list
$color .= " )";}
//echo "color: " . $color . "<br/>";}

if($_POST['Types'] == "null") { $type =""; }
else { $type = "Type ='" . $_POST['Types'] . "'"; }

if(!$name and !$color and !$type) {$where = "";}
else {$where = " WHERE "; }
if(!$name) {$and1 = "";} else if (!$color and !$type) {$and1 = "";} else {$and1 = " AND ";}
if(!$color) {$and2 = "";} else if (!$type) {$and2 = "";} else {$and2 = " AND ";}



$sql = "SELECT * FROM Cards" .$where .$name. $and1 .$color . $and2. $type  ; 
//echo $sql;

//connect to database, need host usr pwd
@ $db = mysql_connect('localhost', 'root', 'lyoko');
if (!$db)
{ echo 'Error: Could not connect to database.  Please try again later.';
  exit;
}
//select a database to work with
$selected = mysql_select_db("MagicDB",$db)
  or die("Could not select MagicDB");

$result = mysql_query($sql);
if(!$result) { echo 'SQL ERROR PLZ TRY AGAIN'; }

// get number of rows
$num_results = mysql_num_rows($result);
//echo $num_results;
//display table
echo " <table style=\"width:100%; border: 1px solid black; border-collapse: collapse;\">
       <tr> <td>Card Name</td> <td>Manacost</td> <td>Converted Manacost</td> <td>Color</td> <td>Type</td> <td>Description</td> </tr> ";

// display each card in a row
for ($i=0; $i <$num_results; $i++)  { 
$row = mysql_fetch_row($result);   
echo "<tr><td>" . $row[0] . "</td><td>" . $row['1'] . "</td><td>" . " "
.$row['2'] . "</td><td>" . $row['3'] . "</td><td>" . $row['4'] . "</td><td>" . " "
.$row['5'] . "</td></tr>";

}
//close table
echo " </table> " ;

?>
      <h2>&nbsp;</h2>
    </article>
  </div>
     <aside id="sidebar"></aside>
  <footer>
    <p>Magic: the Gathering © Copyright Wizards of the Coast</p>
  </footer>
</div>
</body>
</html>