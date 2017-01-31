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

if(isset($_GET['card_id'])){
    $card_id = $_GET['card_id'];
}

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

if(isset($_POST['textarea'])){
    $comment = $_POST['textarea'];
}


// delate cards
$query = 'UPDATE cards SET `name` = ' .  $employee . ', `comment` = "'. $comment. '", `block` = ' . $block. ', `active` = '. $active . ', `new` = 0 WHERE `id` = ' . $card_id .';';
echo $query;
$result = mysqli_query($connection, $query);
$url =  "add_card_view.php?menu_id=${menu_id}&action_id=${action_id}&card_id={$card_id}";
if(!$result){
	$_SESSION["edited"] = "fail";
	header('Location: '.$url);
    //die('QUERY FAILED' . mysqli_errno());
}
else{
	$_SESSION["edited"] = "success";
    header('Location: '.$url);
    //echo $url;
}

?>