<?php require_once("../db/db.php"); ?>
<?php 
//session_start();

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

$menu_id = '';

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}


$query = "SELECT * FROM module ORDER BY sequence"; 
$result = mysqli_query($connection, $query);
	
if(!$result){
	die('QUERY FAILED' . mysqli_errno());
}  
?>

<nav class="navbar navbar-default navbar-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
      
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown <?php if($menu_id == 0) echo ' active' ?>">
                    <a href="../base/index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if($menu_id == 0) echo 'class="active"' ?>> <a href="../base/index.php?menu_id=0">Configuracíon</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../index.php?logout=true">Salir</a></li>
                    </ul>
                </li>
            </ul>
                
            <ul class="nav navbar-nav navbar-left">
                <?php
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
						if($row['active']==1){
							echo "<li";
							if($menu_id == $row['id']) echo " class='active'";
							echo ">";
							echo "<a href='";
							echo "../" . $row['link'] . '?menu_id=' . $row['id'];
							echo "'>";
							echo $row['name'];
							echo "</a>";
							echo "</li>";
						}
                    endwhile;  
                ?>
            </ul>           
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>