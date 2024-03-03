<?php
session_start();
@$login=$_SESSION['login'];
if(!empty($login)){
    header('Location:index.php');
}

 include('function_connexion.php');
if(isset($_POST['seConnecter']))
{

	$login=$_SESSION['login'] = $_POST['login'];
	$req=$conn->prepare("SELECT COUNT(id) FROM tb_consommation WHERE login ='$login' ");
	$req->execute();
	 $count=$req->fetchColumn();

	 if($count>0)
     {
    header("location:index.php");
    }
	else { $msg='Ce mot de passe est incorrect !'; }
}
?>
<!doctype html>
<html lang="fr">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div align='center' style="color:red" ><b> <?php echo @$msg; ?> </b></div>
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Code de Demande de Carte</h3>
					<form method="post" class="login-form">
		      		<div class="form-group">
		      			<input type="text" name="login" class="form-control rounded-left" placeholder="Username 1" required>
		      		</div>
	            <!--div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" required>
	            </div-->

	            <div class="form-group">
	            	<button type="submit" name="seConnecter"  class="btn btn-primary rounded submit p-3 px-5">Se Connecter</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

