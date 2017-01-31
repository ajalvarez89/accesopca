<?php
session_start();

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

header("Content-type: text/html; charset=utf-8");
require_once("../db/db.php");

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

$employee = "";
$active ="";
$comment = "";

if(isset($_POST['selectEmployee'])){
    $employee = $_POST['selectEmployee'];
}

if(isset($_POST['active'])){
    $active = $_POST['active'];
    if($active==1)
        $block = "0";
    else{
        $block = '1';
    }
}
$comment = " ";
if(isset($_POST['textarea'])){
    $comment = $_POST['textarea'];
}

$query = "SELECT * FROM new_cards;";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$card_id = $row['card_id'];

#clear new card table
$query = "UPDATE new_cards SET `status` = 0, `card_id` = '' WHERE id = 1;";
$result = mysqli_query($connection, $query);

#check if card_id already exists

$query = "SELECT * FROM cards;";
$result = mysqli_query($connection, $query);
$exists = False;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
	if($row['card_id'] == $card_id){
		$exists = True;
	}
endwhile;

if($exists){
	$url =  "add_new_card.php?menu_id=${menu_id}&action_id=${action_id}&add=True";
	$_SESSION["exists"] = True;
	header('Location: '.$url);
}
else{
	$query = 'INSERT INTO cards (`card_id`, date, `block`, `active`, `new`, `comment`) VALUES ("'.$card_id . '",now(),0, 0, 1,"'. $comment . '");';

	$result = mysqli_query($connection, $query);
	$url =  "cards.php?menu_id=${menu_id}&action_id=${action_id}";

	$query = "UPDATE new_cards SET `card_id` = Null WHERE id = 1;";
	$result = mysqli_query($connection, $query);

	if(!$result){
		header('Location: '.$url);
		//die('QUERY FAILED' . mysqli_errno());
	}
	else{
		header('Location: '.$url);
		//echo $url;
	}
}

?>