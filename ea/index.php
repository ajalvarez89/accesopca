<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

include('../functions/functions.php');

$menu_id = '';
$action_id = '';
$page = 1;
$record_on_page = 20;

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['page'])){
	$page = $_GET['page'];
}


$query = "SELECT * FROM attendance;";
$result = mysqli_query($connection, $query);
$page_count = ceil(mysqli_num_rows($result) / $record_on_page);

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Acceso Electronico</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        
        <?php include('../views/slider.php'); ?>

        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                
                <?php include('../views/nav_menu.php'); ?>
                
                <!--<div class="padding-top-20"></div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                            </div>
                            <div class="col-xs-8 col-sm-6 col-md-4 col-lg-3 pull-right">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="filter" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!--<div class="form-group pull-left">  -->
                                <!--    <button type="submit" class="btn btn-success btn-sm" name="submit" form="add_user">Save</button>-->
                                <!--    <a href="#" class="btn btn-default btn-sm" role="button">Cancel</a>-->
                                <!--    <a href="#" class="btn btn-primary btn-sm" role="button">Add user</a>    -->
                                <!--</div>-->
                                <!--<div class="btn-group pull-right">-->
                                <!--    <a href="?list=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>-->
                                <!--    <a href="?box=1" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>-->
                                <!--    <a href="?form=1&view=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>-->
                                <!--</div>-->
								<?php

								
								?>
                                <div class="btn-group pull-right">
                                    <a href="<?php echo '?menu_id=' . $menu_id . '&action_id=' . $action_id . '&page='; if(($page-1) == 0) echo '1'; else echo ($page-1); ?>" class="btn btn-default btn-sm <?php if(($page-1) == 0) echo ' disabled'; ?>" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                                    <a href="<?php echo '?menu_id=' . $menu_id . '&action_id=' . $action_id . '&page=' . ($page+1); ?>" class="btn btn-default btn-sm <?php if($page == $page_count) echo ' disabled'; ?>" role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                </div>    
                                <h5 class="pull-right padding-right-10"><?php echo $page . '/'. $page_count; ?></h5>
                            </div>
                        </div>
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><small>Registro de Acceso</small></h3><br>
									<?php
									if(isset($_GET['page']) && $_GET['page'] !=1){
										echo '<div class="table-responsive">';
										attendance_paging($menu_id, $action_id, $connection, $page);
										echo '</div>';	
									}
									else if(isset($_GET['page'])) {
										echo '<div class="table-responsive" id="attending_tbl">';
										echo '</div>';
									}
									else if (!isset($_GET['page'])) {
										echo '<div class="table-responsive" id="attending_tbl">';
										echo '</div>';
									}
								?>			
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../base/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../base/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
	function refreshData()
	{
	  $('#attending_tbl').load('attending_tbl.php');
	}
	// Execute every 5 seconds
	window.onload = refreshData;
	window.setInterval(refreshData, 1000);
	
	$(document).ready(function () {
    (function ($) {
        $('#filter_disable').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        })
        }(jQuery));
    });
	
	
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
	
	
    </script>

</body>

</html>
