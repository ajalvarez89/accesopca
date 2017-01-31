<?php

    require_once("../db/db.php");
	require_once("../functions/functions.php");
    $card_id = '';
    $add = '';
	
    if(isset($_GET['card_id'])){
        $card_id = (string)$_GET['card_id'];
		$card_id = strtoupper($card_id);
    }
	
	if(isset($_GET['add'])){
        $add = (string)$_GET['add'];  
    }

	$query = "SELECT * FROM new_cards;";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new = $row['status'];
	
	if($new == 1){
		$query = "UPDATE new_cards SET `card_id` = ${card_id} WHERE id = 1;";
		$result = mysqli_query($connection, $query);
		echo "CLOSE";
	}
	
	if($new == 0){
		# revisa si existe id de tarjeta
		$check_q = "SELECT * FROM cards";
		$result = mysqli_query($connection, $check_q);
		
		$status = '';
			
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
			if($row['card_id'] == trim($card_id, "\"")):
				if($row['block'] == 1)
					$status = 'block';
				if($row['active'] == 1)
					$status = 'active';
			endif;
		endwhile;
				
		if($status == 'block'){
			echo "CLOSE";
			attendance($card_id, "block", $connection);
		}
		else if($status == 'active'){
			echo "OPEN";
			attendance($card_id, "open", $connection);
		}
		else{
			echo "CLOSE";
			attendance($card_id, "block", $connection);
		}
	}
?>
