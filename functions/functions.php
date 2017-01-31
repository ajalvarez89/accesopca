<?php
require_once("../db/db.php");

//ative cards
function get_active_cards($connection, $menu_id, $action_id){
    $query = "SELECT * FROM cards WHERE active=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-center">ID Tarjeta</th>';
    echo '<th>Nombre</th>';
    echo '<th class="text-center">Fecha</th>';
    echo '<th class="text-center">Editar</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody class="searchable">';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id='.$row['id'] . '">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-center">' .$row['card_id'] . '</td>';
        $get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
        $rt = mysqli_query($connection, $get_user);
        $user = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td>' . $user['name']. '</td>';
        echo '<td class="text-center">' . $row['date']. '</td>';
        echo '<td class="text-center"><a class="btn btn-warning btn-xs active" role="button" href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">' . '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

function active_cards_count($connection){
    $query = "SELECT active FROM cards WHERE active=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    $rowcount=mysqli_num_rows($result);
    echo $rowcount;
}
// end active cards

//sacar el numero total de atenciones
function atencion_active($connection){
$query = "SELECT * FROM attendance";
$result = mysqli_query($connection, $query);
if(!$result){
    die('QUERY FAILED' . mysqli_errno());
}
$rowcount=mysqli_num_rows($result);
    echo $rowcount;
}



// sacar el numero total de empleados registrados
function user_active($connection){
$query = "SELECT * FROM employee";
$result = mysqli_query($connection, $query);
if(!$result){
    die('QUERY FAILED' . mysqli_errno());
}
$rowcount=mysqli_num_rows($result);
    echo $rowcount;
}
// new cards
function get_new_cards($connection, $menu_id, $action_id){
    $query = "SELECT * FROM cards WHERE new=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-center">ID Tarjeta</th>';
    echo '<th class="text-center">Fecha</th>';
    echo '<th class="text-center">Editar</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody class="searchable">';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-center">' .$row['card_id'] . '</td>';
        echo '<td class="text-center">' . $row['date']. '</td>';
        echo '<td class="text-center"><a class="btn btn-warning btn-xs active" role="button" href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">' . '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

function new_cards_count($connection){
    $query = "SELECT new FROM cards WHERE new=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    $rowcount=mysqli_num_rows($result);
    echo $rowcount;
}

// end new cards

// block cards
function get_block_cards($connection, $menu_id, $action_id){
    $query = "SELECT * FROM cards WHERE block=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-center">ID Tarjeta</th>';
    echo '<th>Nombre</th>';
    echo '<th>Fecha</th>';
    echo '<th class="text-center">Editar</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody class="searchable">';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-center">' .$row['card_id'] . '</td>';
        $get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
        $rt = mysqli_query($connection, $get_user);
        $user = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td>' . $user['name']. '</td>';
        echo '<td>' . $row['date']. '</td>';
        echo '<td class="text-center"><a class="btn btn-warning btn-xs active" role="button" href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">' . '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

function block_cards_count($connection){
    $query = "SELECT block FROM cards WHERE block=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    $rowcount=mysqli_num_rows($result);
    echo $rowcount;
}

function get_user_list($connection, $employee){    
    $query = "SELECT * FROM employee;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<option value="" disabled selected>Empleado</option>';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<option value="'. $row['id'] . '"';
        if($row['id'] == $employee) echo " selected";
        echo '><a href="">' . $row['name']. '</a></option>';
    endwhile;

}

//end block cards

// module list
function get_all_modules($connection, $menu_id, $action_id){
    $query = "SELECT * FROM module;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed table-responsive">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-center">Modulo</th>';
    echo '<th class="text-center">Folder</th>';
    echo '<th class="text-center">Estado</th>';
    echo '<th class="text-center">Fecha</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody>';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-center">' .$row['name'] . '</td>';
        echo '<td class="text-center">' . $row['link']. '</td>';
        echo '<td class="text-center">'; if($row['active'] == 1) echo "Activo"; else echo "Inactivo"; echo '</td>';
        echo '<td class="text-center">02.12.2016</td>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

function get_all_users($connection, $menu_id, $action_id){
    $query = "SELECT * FROM users;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed table-responsive">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-left">User</th>';
    echo '<th class="text-left">Password</th>';
    echo '<th class="text-left">Status</th>';
    echo '<th class="text-left">Date</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody>';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_card_view.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&card_id=' . $row['id'] . '&edit=true">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-left">' .$row['username'] . '</td>';
        echo '<td class="text-left">' . $row['password']. '</td>';
        echo '<td class="text-left">'; if($row['status'] == 1) echo "Activo"; else echo "Inactivo"; echo '</td>';
        echo '<td class="text-left">' .$row['password'] . '</td>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

function first_card_id($connection, $menu_id, $action_id){
	$query = "SELECT * FROM cards LIMIT 1;";
	$result = mysqli_query($connection, $query);
	$i = mysqli_fetch_array($result, MYSQLI_ASSOC);
	return $i['id'];
}

function next_prev_btn($connection, $menu_id, $action_id, $card_id){
	$query = "SELECT * FROM cards;";
	$result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
	$index = array();
	$i = 0;
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
		$index[$i] = $row['id'];
		$i++;
	endwhile;
	
	$card_number = 0;
	
	for($i = 0; $i < count($index); $i++){
		if($index[$i] == $card_id)
			$card_number = $i;
	}
	
	echo '<div class="btn-group pull-right padding-right-10">';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
		$next='';
		$prev = '';
		if($card_number-1 < 0)
			$prev = 0;
		else
			$prev = $card_number - 1;
			
		if($card_number+1 > count($index)-1)
			$next = count($index)-1;
		else
			$next = $card_number+1;
		
		echo '<a href="?menu_id='.$menu_id . '&action_id='. $action_id . '&card_id=' . $index[$prev] .'" class="btn btn-default btn-sm "'; if($card_number == 0) echo "disabled"; echo ' role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>';
		echo '<a href="?menu_id='.$menu_id . '&action_id='. $action_id . '&card_id=' . $index[$next] .'" class="btn btn-default btn-sm "'; if($card_number == count($index)-1) echo "disabled"; echo ' role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>';
	echo '</div>';
	$card_number+=1;
    echo '<h5 class="pull-right padding-right-10">' . $card_number .'/'. count($index) . '</h5>';
}

// module list
function get_all_employee($connection, $menu_id, $action_id){
    $query = "SELECT * FROM employee;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    echo '<table class="table table-hover table-condensed table-responsive">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th class="text-left">Nombre</th>';
    echo '<th class="text-center">Edad</th>';
    echo '<th class="text-center">Telefono</th>';
    echo '<th class="text-left">E-mail</th>';
    echo '</tr>';
	echo '</thead>';
    echo '<tbody>';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr class="clickable-row" data-href="add_new_employee.php?menu_id='.$menu_id. '&action_id=' . $action_id . '&employee_id=' . $row['id'] . '">';
        echo '<td>' . $i . '</td>';
        echo '<td class="text-left">' .$row['name'] . '</td>';
        echo '<td class="text-center">' . $row['date']. '</td>';
        echo '<td class="text-center">' . $row['telephone'] .'</td>';
        echo '<td class="text-left">' . $row['email'] .'</td>';
        echo '<tr>';
        $i++;
    endwhile;
    echo '</tbody>';
    echo '</table>';
}

//check_card,
function attendance($card_id, $status, $connection){		
	$query = "SELECT * FROM cards WHERE card_id = ".  $card_id . " LIMIT 1";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	$card_id = $row["id"];
	$user_id = $row['name'];
	$date= date("d-m-Y");
	$time = date('H:i:s');
	$in_out = "in";
	
	$query = "SELECT * FROM attendance WHERE name = ". $user_id . " ORDER BY id DESC";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if($status=='open'){
		if ($row['status']=='in'){
			$in_out = "out";
		}
		else if ($row['status']=='out'){
			$in_out = "in";
		}
		else if ($row['status']=='block'){
			$in_out = "in";
		}
		
		$query = 'INSERT INTO attendance (`name`, date, `time`, `timetable`, `status`, `entrance`, `card_id`) VALUES ('. $user_id . ',now(),"'. $time .'", 0,"'. $in_out. '",0,'. $card_id . ');';
	
		$result = mysqli_query($connection, $query);
	}
	else if($status=='block'){
		$in_out = "block";
		$query = 'INSERT INTO attendance (`name`, date, `time`, `timetable`, `status`, `entrance`, `card_id`) VALUES ('. $user_id . ',now(),"'. $time .'", 0,"'. $in_out. '",0,'. $card_id . ');';
		$result = mysqli_query($connection, $query);
	}
}

function attendance_paging($manu_id, $action_id, $connection, $page){
	$from = 20*($page-1);
	$to = 20*($page);
	$query = "SELECT * FROM attendance ORDER BY id DESC LIMIT " . $from. ", " . $to . ";";
	$result = mysqli_query($connection, $query);
		
	if(!$result){
		die('QUERY FAILED' . mysqli_errno());
	}

	echo '<table class="table table-hover table-condensed">';
	echo '<tr>';
	echo '<th>#</th>';
	echo '<th>Nombre</th>';
	echo '<th>Fecha</th>';
	echo '<th>Hora</th>';
	echo '<th class="text-center">Time Table</th>';
	echo '<th class="text-center">Estado</th>';
	echo '<th class="text-center">Entrada</th>';
	echo '<th class="text-center">Tarjeta ID</th>';
	echo '</tr>';
	echo '<tbody class="searchable">';
		$i = 1 + 20*($page-1);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
			echo '<tr>';
			echo '<td>' . $i . '</td>';
			$get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
			$rt = mysqli_query($connection, $get_user);
			$user = mysqli_fetch_array($rt, MYSQLI_ASSOC);
			echo '<td>' . $user['name']. '</td>';
			echo '<td>' . $row['date']. '</td>';
			echo '<td>' . $row['time']. '</td>';
			echo '<td class="text-center">' . $row['timetable']. '</td>';
			echo '<td class="text-center" ';
				if($row['status']=='in') echo "bgcolor=#009a57><font color='#fff'>";
			   
				else if($row['status']=='out') echo "bgcolor=#186dee><font color='#fff'>";
				else if($row['status']=='block') echo "bgcolor=#dc4c38><font color='#fff'>";
				echo $row['status'];
			echo '</font></td>';
			echo '<td class="text-center">' . $row['entrance']. '</td>';
			$card_id = 'SELECT * FROM cards WHERE id="' . $row["card_id"] .'" LIMIT 1;';
			$rt = mysqli_query($connection, $card_id);
			$card_id = mysqli_fetch_array($rt, MYSQLI_ASSOC);
			echo '<td class="text-center">' . $card_id['card_id']. '</td>';
			echo '<tr>';
			$i++;
		endwhile;
	echo '</tbody>';
	echo '</table>';
}


?>