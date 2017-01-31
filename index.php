<!DOCTYPE html>
<?php
session_start();
include('config/config.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DATABASE);

if (isset($_SESSION['user'])){
        header('Location: dboard/index.php');
    }


if(isset($_POST['submit'])){
	if(!$connection){
		die("connection fail");
	}
	
	if (!$connection->set_charset("utf8")) {
		 printf("Error loading character set utf8: %s\n",$connection->error);
	} 
	
	$query = "SELECT * FROM users"; 
	$result = mysqli_query($connection, $query);
		
	if(!$result){
		die('QUERY FAILED' . mysqli_errno());
	}
	
	if(isset($_POST['password']))
		$pass = $_POST['password'];
	if(isset($_POST['username'])) 
		$user = $_POST['username'];
	//echo $pass . $user;
		
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
		if ($user == $row['username'] and $pass == $row['password']){
			$_SESSION['user']= $user;
			header('Location: ea/index.php');
		}
		//else
			//header('Location: index.php');
	endwhile;
}

if(isset($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
}
//
?>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="base/images/Iconka-Pool-Pool-bird.ico">
		<title>PCA ACCESO</title>
		<!-- Bootstrap core CSS -->
		<link href="base/css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="base/css/signin.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>

	<body>
		<div class="container">
			<form class="form-signin" action="index.php" method="POST">
			<img src="base\images\logopca.png" width="300" height="100">

				<h3 class="form-signin-heading" align="center"><small>Sistema de Ingreso </small></h3>
				<form class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="exampleInputAmount"></label>
						<div class="input-group">
						  <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						  <input type="text" name="username" class="form-control" id="exampleInputAmount" placeholder="Usuario" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
						  <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock" aria-hidden="true"></span></div>
						  <input type="password" name="password" class="form-control" id="exampleInputAmount" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> Recuerdame
						</label>
					</div>
					<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">INGRESAR</button>

			    </form>
            </form>
		</div> <!-- /container -->
			
  </body>
</html>
