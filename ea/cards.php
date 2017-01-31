<!DOCTYPE html>

<?php 
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');
	
include('../functions/functions.php');

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Acceso Electronico</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <link href="../base/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php include('../views/slider.php'); ?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <?php include('../views/nav_menu.php'); ?>
                <!--<div class="padding-top-20"></div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                                <!--<h5>card list / jemali</h5>-->
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
                               <div class="form-group pull-left">
                        <!--            <button type="submit" class="btn btn-success btn-sm" name="submit" form="add_user">Save</button>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button">Cancel</a>-->
                                    <!--<a href="add_new_card.php" class="btn btn-primary btn-sm" role="button">ბარათის დამატება</a>    -->
                        <!--        </div>-->
                        <!--        -->

                                    <div class="btn-group pull-right">
                                        <!--<a href="" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>-->
                                        <?php echo '<a href="add_new_card.php?menu_id='. $menu_id . '&action_id='. $action_id .'&add=True" class="btn btn-primary btn-sm" role="button">Add</a>';?>               
                                    </div>

                        <!--        -->
                        <!--        -->
                        <!--        <div class="btn-group pull-right padding-right-10">-->
                        <!--            &nbsp;&nbsp;&nbsp;&nbsp;                      -->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>-->
                        <!--        </div>    -->
                        <!--        <h5 class="pull-right padding-right-10">5/10</h5>-->
                                </div>
                            </div>
                        </div>
                        
                        <hr class="line">
                        <!-- group titles -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><small>Administrador de Tarjetas</small></h3>
                            </div>
                        </div>
                        
                        <!-- content -->
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">
												<a href="#" data-toggle="collapse" data-target="#" aria-expanded="true" class="panel-link">Tarjetas Registradas <span class="label label-success"><?php active_cards_count($connection); ?></span></a>
                                            </div>
											<div id="improvementsPanel" class="panel-collapse collapse in" aria-expanded="true">
												<?php get_active_cards($connection, $menu_id, $action_id); ?>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">
												<a href="#" data-toggle="collapse" data-target="#improvementsPanel_01" aria-expanded="true" class="panel-link">Nuevas Tarjetas <span class="label label-warning"><?php new_cards_count($connection); ?></span></a>
											</div>
											<div id="improvementsPanel_01" class="panel-collapse collapse in" aria-expanded="true">
												<?php get_new_cards($connection, $menu_id, $action_id); ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">
												<a href="#" data-toggle="collapse" data-target="#improvementsPanel_02" aria-expanded="true" class="panel-link">Tarjetas Bloqueadas <span class="label label-danger"><?php block_cards_count($connection); ?></span></a>
											</div>
											<div id="improvementsPanel_02" class="panel-collapse collapse in" aria-expanded="true">
												<?php get_block_cards($connection, $menu_id, $action_id); ?>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div id="test"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../base/js/jquery.js"></script>
    <script src="../base/js/bootstrap-select.js""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../base/js/bootstrap.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
    
	jQuery(document).ready(function($) {
		$(".clickable-row").click(function() {
			window.document.location = $(this).data("href");
		});
	});
    
    $(document).ready(function () {
    (function ($) {
        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        })
        }(jQuery));
    });
    
    $(document).ready(function () {
        var mySelect = $('#first-disabled2');
    
        $('#special').on('click', function () {
          mySelect.find('option:selected').prop('disabled', true);
          mySelect.selectpicker('refresh');
        });
    
        $('#special2').on('click', function () {
          mySelect.find('option:disabled').prop('disabled', false);
          mySelect.selectpicker('refresh');
        });
    
        $('#basic2').selectpicker({
          liveSearch: true,
          maxOptions: 1
        });
      });
    
    </script>

</body>
</html>
