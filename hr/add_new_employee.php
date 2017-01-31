<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

include_once('../functions/functions.php');
require_once("../db/db.php");
header("Content-type: text/html; charset=utf-8");

$menu_id = '';
$action_id = '';
$status = '';
$add = '';
$edit = '';
$date= date("Y-d-m");
$exists=False;
$employee_id = '';
$edited ='';
$name='';
$telephone = '';
$email = '';


if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['employee_id'])){
    $employee_id = $_GET['employee_id'];
}

if(isset($_GET['edit'])){
    $edit = $_GET['edit'];
}

if(isset($_GET['add'])){
	$add = $_GET['add'];
}

if(isset($_SESSION["edited"])){
	$edited = $_SESSION["edited"];
}

if(isset($_GET['employee_id'])){
	require_once("../db/db.php");
	$query = "SELECT * FROM employee WHERE id=" . $employee_id . " LIMIT 1;";
	$result = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
		$name = $row['name'];
		$date = $row['date'];
		$telephone = $row['telephone'];
		$email = $row['email'];
	endwhile;
}


?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agregar Personas</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <link href="../base/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
	<link href="../base/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="../base/js/bootstrap-datepicker.js" rel="stylesheet">
	
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
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <div class="row">
                            <div class="col-lg-12">
								<div class="form-group pull-left">  
                                    <!--<button type="submit" class="btn btn-warning btn-sm" name="submit" form="add_user">Edit</button>-->
                                    <?php
                                    if(isset($_GET['add']) || isset($_GET['edit'])){
										echo '<button type="submit" class="btn btn-success btn-sm" name="submit" form="save_employee">Save</button>';	
									}
                                    else{
										echo '<a href="?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id=' . $employee_id . '&edit=true" class="btn btn-warning btn-sm" role="button">Edit</a>';
										echo ' <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Delete</button>';
										echo ' <a href="index.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '" class="btn btn-default btn-sm" role="button">Back</a>';
									}
                                    ?>

									<?php
										if($edit=='true'){
										    echo '<a href="add_new_employee.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id=' . $employee_id . '" class="btn btn-default btn-sm" role="button">Cancel</a>';
										}
										if($add=='True'){
										    echo '<a href="index.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '" class="btn btn-default btn-sm" role="button">Cancel</a>';
										}
                                    ?>
                                    <!--<a href="#" class="btn btn-primary btn-sm" role="button">Add user</a>    -->
                                </div>
								
								<div class="modal fade" id="deleteModal">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;Alerta!</h4>
									  </div>
									  <div class="modal-body">
										<p>Seguro de Eliminar este Registro?</p>
									  </div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary btn-sm" id="deleteBtn">Si</button>
											<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
										</div>
									</div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
                                    
								
								
                                
                                <div class="btn-group pull-right">
                                    <a href="index.php?menu_id=<?php echo $menu_id; ?>&action_id=<?php echo $action_id; ?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                                    <a href="" class="btn btn-default btn-sm active"role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
                                </div>
                                
                                <!-- NEXT - PREV BUTTONS RIGHT FUNCTION-->
                              <!--   <?php //next_prev_btn($connection, $menu_id, $action_id, $employee_id); ?> -->
								<!-- END NEXT - PREV BUTTONS RIGHT FUNCTION-->
                            </div>
                        </div>
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-offset-2"> 
												<?php if($edited == "success"): ?>
												<?php echo '<div  id="successMessage" class="alert alert-success alert-dismissible" role="alert">';?>
												<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';?>
												<?php echo '<strong>Warnign!</strong> Success!';?>
												<?php echo '</div>';?>
												<?php $_SESSION["edited"] = False; ?>
												<?php endif; ?>
												<?php if($edited == "fail"): ?>
												<?php echo '<div id="successMessage" class="alert alert-warning alert-dismissible" role="alert">';?>
												<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';?>
												<?php echo '<strong>Warnign!</strong> Somthing wrong!';?>
												<?php echo '</div>';?>
												<?php $_SESSION["edited"]=False; ?>
												<?php endif; ?>											
												<div class="panel panel-default">
                                                    <!-- Default panel contents -->
                                                    <div class="panel-heading">Formulario Personas</div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="save_new_employee.php?menu_id=<?php echo $menu_id . '&action_id='. $action_id . '&employee_id=' . $employee_id; ?>" method="POST" id="save_employee"  class="form-horizontal" accept-charset="UTF-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <fieldset>
                                                                                <!-- Form Name -->
                                                                                <legend><h4>Datos Personales</h4></legend>   
                                                                                <!-- Select Basic -->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="selectbasic">Nombre</label>
                                                                                    <div class="col-md-9">
																						<input type="text" class="form-control input-sm" id="empl_name" value="<?php echo $name; ?>" name="empl_name" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Text input-->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Nacimiento </label>  
                                                                                    <div class="col-md-9">		
																						<div class='input-group date' id='datetimepicker1'>
																							<input type='date' class="form-control input-sm" value="<?php echo $date; ?>" name="date" <?php if($edit != 'true'&& $add!='True') echo 'disabled'; ?>/>     
																							<span class="input-group-addon">
																								<span class="glyphicon glyphicon-calendar"></span>
																							</span>
																						</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Tel.:</label>  
                                                                                    <div class="col-md-9">
                                                                                        <input type="text" class="form-control input-sm" id="tel" value="<?php echo $telephone; ?>" name="tel" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                    </div>
                                                                                </div>
																				<div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">E-mail</label>  
                                                                                    <div class="col-md-9">
                                                                                        <input type="text" class="form-control input-sm" id="email" value="<?php echo $email; ?>" name="email" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                    </div>
                                                                                </div>
																			</fieldset>
                                                                        </div>
																		
                                                                        <div class="col-md-6">
                                                                            <fieldset>
                                                                                <legend><h4>&nbsp;</h4></legend> 
                                                                          
																				
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row (nested) -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
        <!-- jQuery -->
    <script src="../base/js/jquery.js"></script>
    <script src="../base/js/bootstrap-select.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../base/js/bootstrap.min.js"></script>
	<script src="https://raw.githubusercontent.com/eternicode/bootstrap-datepicker/master/js/bootstrap-datepicker.js"></script>
	<!-- Menu Toggle Script -->
    <script>

		
	$(document).ready(function(){
         $(function () {
                $('#datetimepicker1').datepicker({ Default: 0, });
            });
    });
	
	$(function(){
		$('#deleteBtn').click(function(e){
			e.preventDefault();
			window.location.href = ' <?php echo 'delete_employee.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id='. $employee_id ?>';
		});
	});
	  
		
    //setTimeout(function() {
    //    $('#successMessage_disable').fadeOut("slow");
    //}, 1000); // <-- time in milliseconds 
        
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
        
	        
    //$(document).ready(function () {
    //    var mySelect = $('#first-disabled2');
    //
    //    $('#special').on('click', function () {
    //      mySelect.find('option:selected').prop('disabled', true);
    //      mySelect.selectpicker('refresh');
    //    });
    //
    //    $('#special2').on('click', function () {
    //      mySelect.find('option:disabled').prop('disabled', false);
    //      mySelect.selectpicker('refresh');
    //    });
    //
    //    //$('#basic2').selectpicker({
    //    //  liveSearch: true,
    //    //  maxOptions: 1
    //    //});		
    //});
    
    
    
    </script>

</body>

</html>
