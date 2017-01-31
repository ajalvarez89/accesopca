<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');
	
include('../functions/functions.php'); 
?>
<?php
	if(isset($_GET['menu_id']))
		$menu_id = $_GET['menu_id'];
    if(isset($_GET['action_id']))
		$action_id = $_GET['action_id'];
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel De Control - PCA Acceso</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS navegacion horizontal-->
    <link href="../base/css/bootstrap.css" rel="stylesheet"> 
    <!-- Custom CSS navegacion vertical -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar barra vertical -->
        <div id="sidebar-wrapper">
            <?php include('../views/slider.php'); ?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content Horizontal -->
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
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-12">-->
                        <!--        <div class="form-group pull-left">  -->
                        <!--            <button type="submit" class="btn btn-success btn-sm" name="submit" form="add_user">Save</button>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button">Cancel</a>-->
                        <!--            <a href="#" class="btn btn-primary btn-sm" role="button">Add user</a>    -->
                        <!--        </div>-->
                        <!--        -->
                        <!--        <div class="btn-group pull-right">-->
                        <!--            <a href="?list=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>-->
                        <!--            <a href="?box=1" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>-->
                        <!--            <a href="?form=1&view=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>-->
                        <!--        </div>-->
                        <!--        -->
                        <!--        -->
                        <!--        <div class="btn-group pull-right padding-right-10">-->
                        <!--            &nbsp;&nbsp;&nbsp;&nbsp;                      -->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>-->
                        <!--        </div>    -->
                        <!--        <h5 class="pull-right padding-right-10">5/10</h5>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><small>Panel de control</small></h3>
                                
								<div class="row padding-top-10">
									<!-- <div class="col-md-4">
										<a href="../hr/test.php" class="thumbnail bg-test">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp Notificaciones <span class="label label-success">13</span></h4>
												<h5>13.10.2015</h5>
												</div>
											</div>
										</a>
									</div> -->
									<div class="col-md-4">
										<a href="../hr/?menu_id=1" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp Recurso Humano <span class="label label-danger">
                                                <?php user_active($connection); ?>                                    
                                                </span></h4>
												<h5>Gestiona Personas</h5>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="../ea/?menu_id=2" class="thumbnail bg-red">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acceso Electronico <span class="label label-warning">
                                                 <?php atencion_active($connection); ?>                                     
                                                </span></h4>
												<h5>Valida Ingreso de Personal</h5>
												</div>
											</div>
										</a>
									</div>
									<!-- <div class="col-md-4">
										<a href="moustiers-sainte-marie.jpg" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>&nbsp Tareas <span class="label label-default">13</span></h4>
												<h5>13.10.2015</h5>
												</div>
											</div>
										</a>
									</div> -->
									<!-- <div class="col-md-4">
										<a href="moustiers-sainte-marie.jpg" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-eur" aria-hidden="true"></span>&nbsp Pagos  <span class="label label-default">13</span></h4>
												<h5>13.10.2015</h5>
												</div>
											</div>
										</a>
									</div> -->
									<!-- <div class="col-md-4">
										<a href="moustiers-sainte-marie.jpg" class="thumbnail bg-test">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-bed" aria-hidden="true"></span>&nbsp Modulo Prueba <span class="label label-success">13</span></h4>
												<h5>13.10.2015</h5>
												</div>
											</div>
										</a>
									</div> -->
								
								
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
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
