<?php
  session_start();

  if(!isset($_SESSION['idControl'])){
    $_SESSION['idControl'] = uniqid(); }

  if (empty($_SESSION['usr'])){
    echo "Debe autentificarse!";
    exit(); }
  include './bd/conexion.php';
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Crear Plan</title>
  
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./estilos.css">
	<link rel="stylesheet" href="./font-awesome.css">
  <link rel="stylesheet" type="text/css" href="./css/estilos.css">

  <link rel="icon" href="./img/muscle.png" type="image/png">
	<script src="./main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      function alerta(mensaje){
        alert(mensaje);
      }
      var metricas = function(id){
      //alert(id);
      return  $.getJSON("datosplan.php",{"id": id});
      }
      $('#cmb_plan').on('change',function() {
        //alert(this.value);
        metricas(this.value)
        .done(function(response){
            if(response.success){
              //alert(response.data.mensaje);
              $('#estatura').val(response.data.estatura);
              //alert(response.data.estatura)
              $('#PesoRec').val(response.data.pesoRec);
              $('#PesoMax').val(response.data.pesoMax);
              $('#edad').val(response.data.edad);
              $('#sexo').val(response.data.sexo);
              //alert(response.data.edad);
            }
          }).fail(function(jqXHR, textStatus, errorThrown){alert(textStatus); } );
      });

      var metricas2 = function(id){
        //alert(id);
      return  $.getJSON("datosDieta.php",{"id": id});
      }
      $('#cmb_prote').on('change',function() {
        metricas2(this.value)
        .done(function(response){
            if(!response.success){
             
            }
          }).fail(function(jqXHR, textStatus, errorThrown){alert(textStatus);});
          $('#tablaAjax').load('./HtmlAjax.php');
      });
    });
      //ready
  </script>
</head>
<body>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<a class="navbar-brand" href="./menu.html">
  		<img src="./img/pesas.png" width="65" height="50">
  		</a>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  	<div class="navbar-nav">
    	<a class="nav-item nav-link" href="./clientes/altacliente.php">Alta cliente</a>
    	<a class="nav-item nav-link active" href="./crearplan.php">Crear plan</a>
    	<a class="nav-item nav-link"href="./expediente/expediente.php">Expediente</a>
      <a class="nav-item nav-link"href="./entrenamiento/altaentrenamiento.php">Entrenamiento</a>
  	</div>
 	</div>
	</nav>
   <div class="img-container">
      <img src="./img/logo1.png">
    </div>
  <div class="card text-center">
    <div class="card-header"> Crear plan 
    <span><img src="./img/plan.png"></span> </div>
  </div>
  <div class="container-fluid">
<form id='frmPlan' > 
    <div class="d-flex justify-content-center align-items-center container ">
      <div class="row">
        <div class="col my-2">
          <select id="cmb_plan" name="cmb_plan"  class="form-control">
            <option selected value="0">Elige un cliente</option>
            <?php  
              $qryC='SELECT concat(nombre_paciente," ",apellido_pat," ",apellido_mat) AS nombre_paciente,idPaciente FROM paciente order by nombre_paciente ASC';
              $tablaBD= mysqli_query($link,$qryC);
              while ($registro = mysqli_fetch_array($tablaBD)) {
              echo "<option value='".$registro['idPaciente']."' >";  
              echo $registro['nombre_paciente'];
              echo"</option>";
              }
            ?>       
          </select>
        </div>
      </div>
    </div>
      <div class='my-2 d-flex justify-content-center'>
      <div class='input-group-text'>Peso Minimo: </div>      
      <input id='estaturashw' name='estaturashw' type='text' class='col-sm-2' disabled>

      <div class='input-group-text'>Peso Recomendado: </div>
      <input id='estaturashw2' name='estaturashw2'type='text' class='col-sm-2'  disabled>

      <div class='input-group-text'>Peso Maximo: </div>
      <input id='estaturashw3' name='estaturashw3'type='text' class='col-sm-2'  disabled>

      <input type='hidden' name='edad' id='edad' >
      <input type='hidden' name='estatura' id='estatura' >
      <input type='hidden' name="sexo" id='sexo'>
    </div>
    <div class='my-3 d-flex justify-content-center'>
     <input type="hidden" name="" id="resultadoPliegues">
     <div class='input-group-text'>Biceptal: </div>      
     <input type="text" class="form-control" id="txtBiceptal" name="txtBiceptal" placeholder="Biceptal" autofocus required>

     <div class='input-group-text'>Triceptal: </div>
     <input type="text" class="form-control" id="txtTriceptal" name="txtTriceptal" placeholder="Triceptal" required>

     <div class='input-group-text'>Suprailico: </div>
     <input type="text" class="form-control" id="txtSupra" name="txtSupra"placeholder="Suprailiaco" required>

     <div class='input-group-text'>Sub Escapular: </div>
     <input type="text" class="form-control" id="txtsubEscapular" name="txtsubEscapular"placeholder="Sub Escapular" required>
  </div>
  
  <div class='my-3 d-flex justify-content-center'>
    <div class='input-group-text'>Pectoral: </div>      
    <input type="text" class="form-control" id="txtPectoral"name="txtPectoral" placeholder="Pectoral" required >

    <div class='input-group-text'>Abdominal: </div>   
    <input type="text" class="form-control" id="txtAbdominal" name="txtAbdominal"placeholder="Abdominal" required>

    <div class='input-group-text'>Cuadriciptal: </div> 
    <input type="text" class="form-control" id="txtCuadriciptal" name="txtCuadriciptal"placeholder="Cuadriciptal" required>

    <div class='input-group-text'>Peso Actual: </div>
    <input type="text" class="form-control" id="txtPesoAct" name="txtPesoAct"placeholder="Peso Actual" required>
  </div>

  <div class='my-3 d-flex justify-content-center'>
    <div class='input-group-text'>IMC: </div>      
    <input type="text" class="form-control" id="txtIMC" name="txtIMC"placeholder="IMC" disabled>

    <div class='input-group-text'>Masa Muscular: </div>
    <input type="text" class="form-control" id="txtmasaMus" name="txtmasaMus"placeholder="Masa Muscular" disabled>

    <div class='input-group-text'>Peso Grasa: </div>
    <input type="text" class="form-control" id="txtpesoGrasa" name="txtpesoGrasa"placeholder="Peso: Grasa" disabled>

    <div class='input-group-text'>Grasa Corporal: </div>
    <input type="text" class="form-control" id="txtgrasaCorp"name="txtgrasaCorp" placeholder="Grasa Corporal" >
  </div>
  
  <div class='my-3 d-flex justify-content-center'>
    <div class='input-group-text'>Catch & McCarthy: </div>      
    <input type="text" class="col-sm-2" id="txtCatch" name="txtCatch" placeholder="Catch & McCarthy" disabled maxlength="6">

    <div class='input-group-text'>Woomersly: </div>
    <input type="text" class="col-sm-2" id="txtWoomer"name="txtWoomer" placeholder="Woomersly" disabled>

     <div class='input-group-text'>Ritmo Metabolico Basal: </div>
    <input type="text" class="col-sm-2" id="txtrmb" placeholder="Ritmo Metabolico Basal" disabled>
	</div>

  <div class="d-flex justify-content-center align-items-center container">
    <button type="button" name="btnCalculos" class="btn btn-secondary" 
          onclick="suma();calcularPesos();calcularIMC();catchyMc(); Woomer();">Calcular Medidas <span><img src='./img/cal.png'></span></button>
    <button type="button" name="btnGuardar" class="btn btn-secondary" 
        onclick="javascript: grabar('medidas');">Guardar datos <span><img src='./img/save.png'></span></button>  
        <button type="button" name="btnCalculoGrasa" class="btn btn-secondary" 
          onclick="calpesoGrasa();calmasaMuscular();calrmb();">Calcular Grasa <span><img src='./img/cal.png'></span></button>
  </div>

  <div class="my-3">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Proteinas</label>
  </div>
  <select class="custom-select" id="cmb_prote" name="cmb_prote">
    <option selected>Elige una opcion</option>
      <?php  
        $qryProte='SELECT nombre_nutrimento, id_nutri FROM tabla_nutrimentos where tipo = 1 order by nombre_nutrimento ASC';
        $tablaProte = mysqli_query($link,$qryProte);
        while ($registro = mysqli_fetch_array($tablaProte)) {
        $idNutri = $registro['id_nutri'];
        $nombre_nutri = $registro['nombre_nutrimento'];
        echo "<option value='$idNutri'>$nombre_nutri</option>";
  }
      ?>
  </select>
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Carbohidratos</label>
  </div>
    <select class="custom-select" id="cmb_carbs">
      <option selected>Elige una opcion</option>
        <?php  
          $qryCarbs='SELECT nombre_nutrimento, id_nutri FROM tabla_nutrimentos where tipo = 2 order by nombre_nutrimento ASC';
          $tablaCarbs = mysqli_query($link,$qryCarbs);
          while ($registro = mysqli_fetch_array($tablaCarbs)) {
          $idNutriC = $registro['id_nutri'];
          $nombre_carbs = $registro['nombre_nutrimento'];
          echo "<option value='$idNutriC'>$nombre_carbs</option>";
        }
          ?>
      </select>
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Grasas</label>
  </div>
  <select class="custom-select" id="cmb_grasas">
    <option selected>Elige una opcion</option>
      <?php  
        $qryGrasas='SELECT nombre_nutrimento, id_nutri FROM tabla_nutrimentos where tipo = 3 order by nombre_nutrimento ASC';
        $tablaGrasas= mysqli_query($link,$qryGrasas);
        while ($registro = mysqli_fetch_array($tablaGrasas)) {
        $idNutriG = $registro['id_nutri'];
        $nombre_grasa = $registro['nombre_nutrimento'];
        echo "<option value='$idNutriG'>$nombre_grasa</option>";
        }
      ?>
  </select>

  </div>
  </div>
  <div class="d-flex align-items-center justify-content-center">
    <button class="btn btn-secondary">Guardar Dieta</button>
  </div>
  <div class="d-flex align-items-center justify-content-center" id="tablaAjax">
    
  </div>

  <!--
  <div class="wrap">
		<ul class="tabs">
			<li><a href="#tab1"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 1</span></a></li>
			<li><a href="#tab2"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 2</span></a></li>
			<li><a href="#tab3"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 3</span></a></li>
      <li><a href="#tab4"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 4</span></a></li>
      <li><a href="#tab5"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 5</span></a></li>
			<li><a href="#tab6"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 6</span></a></li>
			<li><a href="#tab7"><span class="fa fa-cutlery"></span><span class="tab-text">Comida 7</span></a></li>

		</ul>

		<div class="secciones">
			<article id="tab1">
				<h4 align="center">Comida 1</h4>
				<textarea placeholder="Comida 1" rows="8" cols="125"></textarea>
			</article>
			<article id="tab2">
      <h4 align="center">Comida 2</h4>
				<textarea placeholder="Comida 2" rows="8" cols="125"></textarea>
      </article>
      <article id="tab3">
      <h4 align="center">Comida 3</h4>
				<textarea placeholder="Comida 3" rows="8" cols="125"></textarea>
      </article>
      <article id="tab4">
      <h4 align="center">Comida 4</h4>
				<textarea placeholder="Comida 4" rows="8" cols="125"></textarea>
      </article>
      <article id="tab5">
      <h4 align="center">Comida 5</h4>
				<textarea placeholder="Comida 5" rows="8" cols="125"></textarea>
      </article>
      <article id="tab6">
      <h4 align="center">Comida 6</h4>
				<textarea placeholder="Comida 6" rows="8" cols="125"></textarea>
      </article>
      <article id="tab7">
      <h4 align="center">Comida 7</h4>
				<textarea placeholder="Comida 7" rows="8" cols="125"></textarea>
			</article>
			
		</div>
	</div>
  -->
    
  <div class="d-flex justify-content-center align-items-center container">
    <div class="col-sm-2 my-1">
      <input type="text" class="form-control" id="txtrequeridas" placeholder="Requeridas">
    </div>
    <div class="col-sm-2 my-2">
      <input type="text" class="form-control" id="txtconsumidas" placeholder="Consumidas">
    </div>
  </div>
  <div class="my-3 d-flex justify-content-center align-items-center">
    <a href="./appPDF/index.php" class="btn btn-secondary">Generar PDF <span><img src="./img/pdf.png"></span></a>
    <button type="button" class="btn btn-secondary">Agregar entrenamiento</button>
    <button type="button" class="btn btn-secondary">Agregar menu</button>
  </div>

  <div class="my-2">
  <div class="card text-center">
    <div class="card-header">
      Suplementos a manejar 
      <span><img src="./img/vitamins.png"></span> </div>
    </div>
  </div>
    <div class="row">
      <div class="col">
      <textarea id="txtSuplementos" rows="6" class="form-control col-sm-6" placeholder="Ingrese suplementos aqui..."></textarea>
      </div>
    </div>
    
  </div>
  </div>
</form>
<footer class="py-4 bg-dark text-white-50 sticky-footer">
    <div class="container text-center">
      <a>Attitude Nutrition Discipline Team</a>
    </div>
    </footer>
</body>
<script type='text/javascript' src='./js/funciones.js'></script>
<script src='./js/calculos.js'></script>
<script src='./js/metodoWomersly.js'></script>
</html>