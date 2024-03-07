#!/usr/local/bin/php
<?php
//money.php
echo 'Either the user or credit was not posted.';
$db = new SQLite3('credit.db');
 $username = $_POST['username'];
 $credit = $_POST['credit'];

//echo $credit;
//echo number_format($credit, 2);

$statement = $db->prepare("UPDATE usersCred SET credit = " . number_format($credit, 2) . " WHERE username = :username");
$statement->bindValue(':username', $username, SQLITE3_TEXT);

$result = $statement->execute();

$db->close();

 ?>


