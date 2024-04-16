<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header('LOCATION:index.php'); die();
}
    require_once("include/sistema.class.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compara Archivos Excel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="assets/scripts.js"></script>
<link href="assets/style.css" rel="stylesheet">
</head>
<body>
<div class="top_menu">
    <div class="name">
      <?php echo  $_SESSION["name_sistema"]; ?>
    </div>

    <div class="logout">
    <a href="logout.php">Salir</a>
    </div>


</div>


<div class="container">
<h2>Comparar Costos Tiendas</h2>

<form method="post" class="section">
<div class="file-drop-area">
  <span class="fake-btn">Selecciona Archivo Tienda #1</span>
  <span class="file-msg">o arrastralo aquí</span>
  <input class="file-input tienda1" type="file" name="tienda1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
</div>

<div class="file-drop-area">
  <span class="fake-btn">Selecciona Archivo Tienda #2</span>
  <span class="file-msg">o arrastralo aquí</span>
  <input class="file-input tienda2" type="file" name="tienda2" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
</div>

 <div class="input-group mb-3 pesos">

  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="text" class="form-control pesos" id="diferencia" name="diferencia" placeholder=".10" aria-label="Cantidad (en centavos o pesos)">
  
</div>

<button class="btn btn-lg btn-primary btn-block submit" type="submit">Subir y Comparar</button>

</form>


<div class="text-center loading">
<span class="spinner-border" style="width: 2rem; height: 2rem;" role="status" aria-hidden="true"></span>
  Cargando y analizando...
</div>

<div class="response"></div>

</div><!-- container -->

</body>
</html>