<?php
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

require_once("../db/db.php");

if(isset($_GET['card_id'])){
    $card_id = $_GET['card_id'];
}

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['delate'])){
    $status = $_GET['delate'];
}

if($status=='new'){
	$query = "UPDATE new_cards SET `card_id` = ' ' WHERE id = 1;";
	$result = mysqli_query($connection, $query);
	
	if(!$result){
		die('QUERY FAILED' . mysqli_errno());
	}
	else{
		$url =  "cards.php?menu_id=${menu_id}&action_id=${action_id}";
		header('Location: '.$url);
		//echo $url;
	}
}

if($card_id){
	$query = 'DELETE FROM cards WHERE `id` = ' . $card_id .';';
	echo $query;
	$result = mysqli_query($connection, $query);
		   
	if(!$result){
		die('QUERY FAILED' . mysqli_errno());
	}
	else{
		$url =  "cards.php?menu_id=${menu_id}&action_id=${action_id}";
		header('Location: '.$url);
		//echo $url;
	}
}


?>