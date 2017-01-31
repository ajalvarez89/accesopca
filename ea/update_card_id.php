<?php
require_once("../db/db.php");

$query = "SELECT * FROM new_cards;";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$card_id= $row['card_id'];

echo $card_id;

?>