<?php 
include '../config.php';
class AJAXDATA {
  
	public function __construct($ruta='',$dim_form=array(),$dim_campos=array(),$tabla='',$tipo='graficos',$post=0,$cevolutivo=''){

		$this->conexion = new \mysqli('localhost',DB_USER,DB_PASSWORD,DB_DB);
		
		if (!$this->conexion->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $mysqli->error);
					exit();
		}
		if ($this->conexion->connect_error) {
					die("Connection failed: " . $conn->connect_error);
		} 
	}
  private function dbconnect() 
	{
    	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DB) or die ("<br/>No conexion servidor");
	$this->c=$conn;     
	mysqli_select_db($conn,DB_DB) or die ("<br/>No se puedo seleccionar la bases de datos");
	return $conn;
  	}

  public function getCentros(){

		$centros=array();
		$i=0;
		$sql="SELECT distinct(codcentro) FROM base_centros be";
		$result= $this->conexion->query($sql);
		while($row=$result->fetch_row()) 
		{
			$centros[$i]=$row[0];
			$i++;
		}
		return $result;
	}
  public function getCentroStats($codcentro)
	{
		$sql="SELECT * FROM base_centros be,stats_centros sc WHERE be.codcentro=sc.codcentro and sc.codcentro='".$codcentro."'";
		$result= $this->conexion->query($sql);
		if($result->num_rows > 0)
		 	return $result->fetch_assoc();	
		else 
			return 0;
	}
  public function genFichaCentro($fichero,$datos,$codcentro)
	{
		//print_r($datos);
		//procesamos los datos binarios, comedor, transporte...
		$bilingue=$datos['bilingue'];
		$filtros=$datos['filtros'];
		$afiltros=explode(";",$filtros);
		$comedor=$afiltros[0];
		$transporte=$afiltros[1];
		$tiemposescolares=$afiltros[2];
		$vcomedor='no';
		if($comedor==1) $vcomedor='si';
		$vtransporte='no';
		if($transporte==1) $vtransporte='si';
		$vtiemposescolares='no';
		if($tiemposescolares==1) $vtiemposescolares='si';
		$vbiling='no';

		$campobusquedaweb=$datos['nombrecentro'].' '.$datos['direccion'];
		$fcen='<div class="row hoja">';
		$fcen.='<div class="card col-md-6">';
		$fcen.='<p class="card-text">Estadísticas '.$datos['nombrecentro'].'</p>';
		$fcen.='<p class="card-text"><small class="text-muted">'.$datos['nalumnos'].' alumnos</small></p>';

		$fcen.='<table class="table">
    <thead class="thead-light">
      <tr>
        <th>Enseñanza</th>
        <th>Alumnos</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Infantil</td>
        <td>'.$datos['nalei'].'</td>
      </tr>
      <tr>
        <td>Primaria</td>
        <td>'.$datos['nalep'].'</td>
      </tr>
      <tr>
        <td>ESO</td>
        <td>'.$datos['naleso'].'</td>
      </tr>
      <tr>
        <td>Bachillerato</td>
        <td>'.$datos['nalbach'].'</td>
      </tr>
      <tr>
        <td>FP</td>
        <td>'.$datos['nalfp'].'</td>
      </tr>
    </tbody>
  </table>
	<img class="card-img-top" src="assets/img/shimg.jpg" alt="imagen sh">
	<div class="card-body">
		<h5 class="card-title"></h5>
	</div>
</div>
<div class="card col-md-6">
	<div class="card-body row">
		<div class="col-md-12">
			<h5 class="card-title">Datos Generales del Centro</h5>
			<p class="card-text"><b>Nombre</b> '.$datos['nombrecentro'].'</p>
			<p class="card-text"><div class="dcentro"><b>Denominación Genérica</b></div> '.$datos['dengenerica'].'</p>
			<p class="card-text"><b>Dirección</b> '.$datos['direccion'].'</p>
			<p class="card-text"><b>CP</b> '.$datos['codpostal'].'</p>
			<p class="card-text"><b>Telefono</b> '.$datos['telefono'].'</p>
			<p class="card-text"><b>Provincia</b> '.$datos['provincia'].'</p>
			<p class="card-text"><b>Comarca</b>  '.$datos['comarca'].'</p>
			<p class="card-text"><b>Zona</b> '.$datos['zona'].'</p>
			<p class="card-text"><b>Localidad</b>  '.$datos['municipio'].'</p>
		</div>
	</div>
	<div class="card-body row">
		<div class="col-md-12">
			<h5 class="card-title">Características del Centro</h5>
			<p class="card-text text-muted"><a href="https://www.google.es/search?q='.$campobusquedaweb.'">Centro en Internet</a></p>
			<p class="card-text"><b>Comedor</b>  '.$vcomedor.'</p>
			<p class="card-text"><b>Transporte</b>  '.$vtransporte.'</p>
			<p class="card-text"><b>Tiempos Escolares</b> '.$vtiemposescolares.'</p>
		</div>
	</div>
	<div class="card-img-top" id="mapacentro" style="width:100%;height:400px;"></div>
</div>
<script>
var uluru = { lat: 41.6575155, lng: -0.9160625 };
var mapcentro = new google.maps.Map(document.getElementById("mapacentro"), 
{
	zoom: 14,
	center: uluru,
});
</script>
</div>';

	$file = fopen($fichero,"w");
	fwrite($file,$fcen);
	fclose($file);
	}
}
 
?>
