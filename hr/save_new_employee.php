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

if(isset($_GET['employee_id'])){
    $employee_id= $_GET['employee_id'];
}


$employee = " ";
$sex =" ";
$date = " ";
$tel = " ";
$mail = " ";
$edit = "";

if(isset($_POST['empl_name'])){
    $employee = $_POST['empl_name'];
}

if(isset($_POST['sex'])){
    $sex = $_POST['sex'];
}

if(isset($_POST['date'])){
    $date = $_POST['date'];
}

if(isset($_POST['tel'])){
    $tel = $_POST['tel'];
}

if(isset($_POST['email'])){
    $mail = $_POST['email'];
}

if($employee_id != Null){
	echo "ganaxele";
	$query = 'UPDATE employee SET `name` = "' .  $employee . '", `date` = "'. $date. '", `telephone` = "' . $tel. '", `email` = "'. $mail . '" WHERE id ='. $employee_id. ';';
	echo $query;
	$result = mysqli_query($connection, $query);
	$url =  "add_new_employee.php?menu_id=${menu_id}&action_id=${action_id}&employee_id={$employee_id}";
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
}

if($employee_id == Null){
	echo "axali";
	$query = 'INSERT INTO employee (`name`, `date`, `telephone`, `email`) VALUES ("'. $employee . '","'. $date .'","' . $tel . '","'. $mail . '");';
	
	$result = mysqli_query($connection, $query);
	$url =  "index.php?menu_id=${menu_id}&action_id=${action_id}";
	
	echo $query;
	//$query = "UPDATE new_cards SET `card_id` = Null WHERE id = 1;";
	
	if(!$result){
		header('Location: '.$url);
		//die('QUERY FAILED' . mysqli_errno());
	}
	else{
		header('Location: '.$url);
	//	//echo $url;
	}
}

?>