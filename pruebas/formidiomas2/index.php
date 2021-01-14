<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V5</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">
				<span class="contact100-form-title">
					Estadística Educativa
				</span>
<?php
$servername = "localhost";
$username = "root";
$password = "Suricato1.fp";
$dbname = "CATARA";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM registroidiomas WHERE codcentro='2222'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		$enseñanza=$row['enseñanza'];
?>			
				<!--INICIO REGISTRO-->	
				<div id="1" class="registro" style="display:contents">
					<div class="wrap-input100 input100-select bg1">
						<span class="label-input100">Enseñanza</span>
						<div>
							<select class="js-select2" name="service">
								<option>Infantil</option>
								<option>Primaria</option>
								<option>Bachillerato</option>
							</select>
							<div class="dropDownSelect2"></div>
						</div>
					</div>

					<div class="wrap-input100 input100-select bg1">
						<span class="label-input100">Curso</span>
						<div>
							<select class="js-select2" name="service">
								<option>Primero</option>
								<option>Segundo</option>
								<option>Tercero</option>
								<option>Cuarto</option>
								<option>Quinto</option>
								<option>Sexto</option>
							</select>
							<div class="dropDownSelect2"></div>
						</div>
					</div>
					<div class="wrap-input100 input100-select bg1">
						<span class="label-input100">Modalidad</span>
						<div>
							<select class="js-select2" name="service">
								<option>Bilingüe Catalán</option>
								<option>Catalán como materia</option>
								<option>Bilingüe Aragonés</option>
								<option>Aragonés como materia</option>
							</select>
							<div class="dropDownSelect2"></div>
						</div>
					</div>
					<div class="wrap-input100 bg1 ">
						<span class="label-input100">Número de alumnos</span>
						<input  class="input100 nalumnos" type="text" name="nalumnos" placeholder="Número de alumnos">
					</div>
				</div>
				<!--FIN REGISTRO-->	
<?php
		echo "id: " . $row["codcentro"]. " - Name: " . $row["enseñanza"]. " " . $row["curso"]. "<br>";
  }
} else {
  echo "0 results";
}
?>
				<div class="container-contact100-form-btn">
					<button id="addregistro" class="contact100-form-btn">
						<span>
							Añadir registro
							<i class="fa fa-plus m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			
			</form>
				<div class="container">
					<button id="enviar">
						<span>
							Enviar
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script>
		 $("#addregistro").click(function(event){
		  event.preventDefault(); 
		  var nreg=$(this).parent().prev().attr("id");
		  var nnreg=parseInt(nreg)+1;
		  var nuevoreg=nnreg;
		  console.log("CLONANDO: "+nreg);

    $("#"+nreg).clone().insertAfter("#"+nreg);
	$(this).parent().prev().attr("id",nnreg);
  });
		
	</script>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="js/ajax.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
