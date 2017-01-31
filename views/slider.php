<?php
require_once("../db/db.php");
$menu_id = '';
$action_id = '';
$first = 0;
if(isset($_GET['menu_id'])){
	$menu_id = $_GET['menu_id'];	
}
if($menu_id==''){
	header('Location: ../dboard/index.php?menu_id=3');
}


if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}
else{
	$action_id = 0;
}

$query = "SELECT * FROM menu WHERE parent=" . $menu_id;

$result = mysqli_query($connection, $query);
	
if(!$result){
    die('QUERY FAILED' . mysqli_errno());
}  

?>

<div id="sidebar-wrapper">
	<div class="brand-img">
		<a href="/dboard"><img src="../base/images/microformats-logo.png"></a>
	</div>
	
	<ul class="sidebar-nav">
		<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
			<?php echo '<li>'; ?>
			<?php echo '<a href="../'. $row['link'] . '?menu_id='. $menu_id . "&action_id=". $row['id'] . '"' ?>
			<?php
				if($action_id == 0 and $first==0){
					echo ' class="active"';
					$first = 1;
				}
				elseif($action_id == $row['id']){
					echo ' class="active"';
				}
			?>
			<?php echo '>'; ?>
			<?php echo '<span class="glyphicon ' . $row['icon'] . '" aria-hidden="true"></span>&nbsp;&nbsp;'; ?>
			<?php echo $row['name']; ?>
			<?php echo '</a>'; ?>
			<?php echo '</li>'; ?>
		<?php endwhile; ?>
	</ul>
</div>