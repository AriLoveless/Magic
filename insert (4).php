<?php

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

$num1 = mysql_num_rows($result1);
if(!$num1) { echo 'no such card exists'; }

else {
$result2 = mysql_query($howMany);
if(!$result2) { echo 'SQL ERROR howMany'; }

$num2 = mysql_num_rows($result2);
if($num2 == 0) {$result3 = mysql_query($addNewCard);
	if(!result) {echo 'SQL Error during addition to inventory';}
echo 'Card has been added to the inventory.';}


$result4 = mysql_query($addCard);
if(!$result4) { echo 'SQL Error during addition to inventory'; }
echo "'Card has been added to the inventory.'";
}
?>


