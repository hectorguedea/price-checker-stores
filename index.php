<?php 
    session_start();
    if(isset($_SESSION['login'])) {
      header('Location:compara.php'); die();
    }

    require_once("include/sistema.class.php");
	$user = new User("","");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Comparativo de Tiendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="assets/scripts.js"></script>
<link href="assets/style.css" rel="stylesheet">

</head>
<body class="login">

 <div class="container">

<form class="form-signin" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <h2 class="form-signin-heading">Acceso al Sistema</h2>
  <label for="inputUser" class="sr-only">Usuario</label>
  <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" required autofocus>
  <label for="inputPwd" class="sr-only">Contraseña</label>
  <input type="password" id="inputPwd" name="inputPwd" class="form-control" placeholder="Contraseña" required>
  <?php 
if(isset($_POST["inputUser"]) && isset($_POST["inputPwd"])) {
   $user = new User($_POST["inputUser"], $_POST["inputPwd"]); 
   $user->get_user();

   if(!$user->get_user()){
	echo '<div class="alert alert-danger" role="alert"> Usuario y contraseña invalidos</div>';
   }

	?>
   <?php 
}

		if($user->checkCookie()!== null && $user->checkCookie()>=3){
?>
      <div class="alert alert-warning" role="alert"> Superaste los 3 intentos para acceder al sistema, por seguridad permitiremos nuevos accesos en 1 hora</div>
	  <?php } else {?>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>

		<?php }?>
 
</form>

</div> <!-- /container -->

</body>
</html>