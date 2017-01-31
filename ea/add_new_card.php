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

$date= date("d-m-Y");

$exists=False;
if (isset($_SESSION['exists']))
	$exists = $_SESSION['exists'];

if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['add'])){
        $add = $_GET['add'];  
    }

if($add == 'True'){
	//CHECK IF RECODR EXISTS
	$check_record = "SELECT * FROM new_cards;";
	$result = mysqli_query($connection, $check_record);
	$rowcount=mysqli_num_rows($result);

	if($rowcount > 0){
		$query = "UPDATE new_cards SET `status` = 1 WHERE id = 1;";
		$result = mysqli_query($connection, $query);
	}
	else{
		$query = "INSERT INTO new_cards (`status`) VALUES (1) WHERE id=1;";
		$result = mysqli_query($connection, $query);
	}
}

if(isset($_POST['card_id'])){
	echo $_POST['card_id'];
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
    <title>Electronic Access</title>
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
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group pull-left">  
                                    <?php
                                        echo '<button type="submit" class="btn btn-success btn-sm" name="submit" form="save_card">Save</button>';
                                    ?>
                                    <?php 
                                        echo '<a href="delete_card.php?menu_id=' . $menu_id . '&action_id=' . $action_id .  '&delate=new" class="btn btn-default btn-sm" role="button">Cancel</a>';
                                    ?>
                                </div>							
                                
                                <div class="btn-group pull-right">
                                    <a href="cards.php?menu_id=<?php echo $menu_id; ?>&action_id=<?php echo $action_id; ?>" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                                    <a href="" class="btn btn-default btn-sm active"role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
                                </div>
                                
                                <!-- NEXT - PREV BUTTONS RIGHT FUNCTION-->
                                <?php //next_prev_btn($connection, $menu_id, $action_id, $card_id); ?>
								<!-- END NEXT - PREV BUTTONS RIGHT FUNCTION-->
                            </div>
                        </div>
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-offset-2"> 
												<?php if($exists): ?>
												<?php echo '<div id="successMessage" class="alert alert-danger alert-dismissible" role="alert">';?>
												<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';?>
												<?php echo '<strong>Warning!</strong> Card ID exists!';?>
												<?php echo '</div>';?>
												<?php $_SESSION["exists"]=False; ?>
												<?php endif; ?>
												<div class="panel panel-default">
                                                    <!-- Default panel contents -->
                                                    <div class="panel-heading">Agregar Nueva Tarjeta</div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="save_new_card.php?menu_id=<?php echo $menu_id . '&action_id='. $action_id; ?>" method="POST" id="save_card"  class="form-horizontal" accept-charset="UTF-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <fieldset>
                                                                                <!-- Form Name -->
                                                                                <legend><h4>Estado</h4></legend>   
                                                                                <!-- Select Basic -->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="selectbasic">ID Tarjeta</label>
                                                                                    <div class="col-md-9">
                                                                                        <p class="form-control-static" id="card_id" name="card_id"></p>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                                <!-- Text input-->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Fecha</label>  
                                                                                    <div class="col-md-9">
                                                                                        <p class="form-control-static"><?php echo $date; ?></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Terminal</label>  
                                                                                    <div class="col-md-9">
                                                                                        <p class="form-control-static">ARDUINO PCA</p>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
																		
                                                                        <div class="col-md-6">
                                                                            <fieldset>
                                                                                <legend><h4>&nbsp;</h4></legend> 
																			
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textarea">Comment</label>
                                                                                    <div class="col-md-9">                     
                                                                                        <textarea class="form-control" id="textarea" name="textarea"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
																		
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            &nbsp;
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        
                                                        <table class="table">
                                                          
                                                        </table>
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
    setTimeout(function() {
        $('#successMessage_disable').fadeOut("slow");
    }, 1000); // <-- time in milliseconds 
        
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
        
	function refreshData()
	{
	  $('#card_id').load('update_card_id.php');
	}

	// Execute every 5 seconds
	window.setInterval(refreshData, 1000);
        
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
    
        //$('#basic2').selectpicker({
        //  liveSearch: true,
        //  maxOptions: 1
        //});		
    });
    
    
    
    </script>

</body>

</html>
