<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Browse</title>
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
      <li>Browse</li>
      <li><a href="invent.php">Inventory List</a></li>
    </ul> 
  </nav>
  </header>
     <div id="hero">
    <article>
 

<?php

//connect to database, need host usr pwd
@ $db = mysql_connect('localhost', 'root', 'lyoko');
if (!$db)
{ echo 'Error: Could not connect to database.  Please try again later.';
  exit;
}
//select a database to work with
$selected = mysql_select_db("MagicDB",$db)
  or die("Could not select MagicDB");

$result = mysql_query("SELECT * FROM Cards");
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
  <article id="main">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </article>
  <aside id="sidebar"> </aside>
  <footer>
    <p>Magic: the Gathering © Copyright Wizards of the Coast</p>
  </footer>
</div>
</body>
</html>
