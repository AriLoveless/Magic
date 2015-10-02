<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complete</title>

<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="/Web stuff/styles/main.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
  <header id = "top">
    <h1>&nbsp;</h1>

  <nav id = "mainnav">
    <ul>
      <li><a href="/Web stuff/magicdb/index.html">Home</a></li>
      <li><a href="search.html">Search</a></li>
      <li>        <a href="insert.php">Insert New Card</a>      </li>
      <li><a href="Browse.php">Browse</a></li>
      <li><a href="invent.php">Inventory List</a><a href="/Web stuff/magicdb/inventory.php"></a></li>
    </ul> 
  </nav>
   </header>
     <div id="hero">
    <article><?php

//name
$name = $_POST['searchinsert']; 
$num_cards = $_POST['quantity']; 
if(!$name || !$num_cards) {echo 'You have not entered enough information. Please try again.';}
$int = (int)$num_cards;
if(!$int) {echo 'You have entered invalid input for number of cards to add. Please try again.';}


$inCards = " select * from Cards where CardName ='" .$name. "'";
$howMany = " select Quantity from Inventory where CardName = ' " .$name. " ' ;";
$addCard = " UPDATE Inventory SET Quantity = Quantity + " .$num_cards. " WHERE CardName = ' ".$name."';";
$addNewCard = " insert into Inventory values (' " .$name. " ', '1'); ";

//connect to database, need host usr pwd
@ $db = mysql_connect('localhost', 'root', 'lyoko');
if (!$db)
{ echo 'Error: Could not connect to database.  Please try again later.';
  exit;
}
//select a database to work with
$selected = mysql_select_db("MagicDB", $db)
  or die("Could not select MagicDB");

$result1 = mysql_query($inCards);
if(!$result1) { echo 'SQL ERROR inCards'; echo mysql_error();}
else {
$num1 = mysql_num_rows($result1);
if(!$num1) { echo 'no such card exists'; }

else {
$result2 = mysql_query($howMany);
if(!$result2) { echo 'SQL ERROR howMany'; }
else{
$num2 = mysql_num_rows($result2);
if($num2 == 0) {$result3 = mysql_query($addNewCard);
	if(!$result3) {echo 'SQL Error during addition to inventory';}
echo 'Card has been added to the inventory.';}
else{
$result4 = mysql_query($addCard);
if(!$result4) { echo 'SQL Error during addition to inventory'; }
echo "'Card has been added to the inventory.'";
}}}}
?>


</article>
  </div>
  <article id="main">
  
    <h2>&nbsp;</h2>
    <p>&nbsp;</p>
    
  </article>
  <aside id="sidebar"> </aside>
  <footer>
    <p>© Copyright 2013 Bayside Beat</p>
  </footer>
</div>
</body>

