<?php 
include '../config.php';
class TOOLS {
	public $conexion; 
  public function __construct(){
		//$this->conexion =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
		$this->conexion = new \mysqli('localhost',DB_USER,DB_PASSWORD,DB_DB);
		if (!$this->conexion->set_charset("utf8")) {
			printf("Error cargando character set utf8: %s\n", $mysqli->error);
					exit();
		}
		if ($this->conexion->connect_error) {
					die("Connection failed: " . $conn->connect_error);
		} 
	}
  public function update_centros($fcsvdata)
	{
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
			{
				while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
				{
				if($numero_registros==0)
				{
					$numero_registros++;
					continue;
				}
				$reg=explode(';',$linea[0]);
				//print_r($reg);exit();
				$codcentro=$reg[0];
				$zona=trim($reg[2]);
				$comarca=trim($reg[3]);
				$municipio=trim($reg[4]);
				$provincia=trim($reg[5]);
				//$nextranjeros=$reg[1];
				//$correo=$reg[2];
				//$telefono=str_replace('.','',$reg[3]);
				//$sql="UPDATE base_centros SET correo='$correo',telefono='$telefono' WHERE codcentro=$codcentro ";
				$sql="UPDATE base_centros SET provincia='$provincia',municipio='$municipio',comarca='$comarca',zona='$zona' WHERE codcentro=$codcentro ";

				if(!$result = mysqli_query($this->conexion,$sql))
				{
						print_r($reg);
						die($sql."\n Error:".mysqli_error($this->conexion));
						
				}
				$numero_registros++;
			}
		}
	return $numero_registros;
	}
  public function load_padron($fcsvdata)
	{
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
		{
			while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
			{
				$sql="INSERT INTO sinee_ine_padron(edad,nacionalidad,año,padron) VALUES(";
				//omitimos cabecera
				if($numero_registros==0)
				{
					$numero_registros++;
					continue;
				}
				$nreg=explode(';',$linea[0]);
				$edad=$nreg[1];
				if(strpos($edad,'TOTAL')!==false)
					continue;
				$sql.="'".$edad."',";
				
				$nacionalidad=$nreg[2];
				if(strpos($nacionalidad,'TOTAL')!==false)
					continue;
				$sql.="'".strtolower($nacionalidad)."',";

				$año=$nreg[4];
				$sql.="'".$año."',";
				$padron=$nreg[5];
				$sql.="'".intval(str_replace(".","",$padron))."')";

				//print($sql);exit();
				if(!$result = mysqli_query($this->conexion,$sql))
				{
					die("\nCONSULTA: $sql Error:".mysqli_error($this->conexion));
				}
				$numero_registros++;

			}
		}
	return $numero_registros;
	}
  public function load_custom_tabla($fcsvdata,$tabla)
	{
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
		{
			while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
			{
				$sql="INSERT INTO $tabla VALUES(";
				//omitimos cabecera
				if($numero_registros==0)
				{
					$numero_registros++;
					continue;
				}
				$nreg=explode(';',$linea[0]);
				//print_r($nreg);exit();
				$curso=$nreg[0];
				$sql.="'".$curso."',";
				$naturaleza=trim($nreg[1],"[]");

				//print("NAT: $naturaleza");
				//print(strpos($naturaleza,'Público'));
				if(strpos($naturaleza,'Público')!==false or strpos($naturaleza,'Centro público')!==false)
					$naturaleza='publico';
				if(strpos($naturaleza,'Privado')!==false or strpos($naturaleza,'Centro privado')!==false)
					$naturaleza='privado';
				//print("FIN NAT $naturaleza");exit();
				$sql.="'".$naturaleza."',";
				$dengenerica=$nreg[2];
$fcsv="../../datos/datos_auxiliares/datos_globales/extranjeros_centro.csv";
				$sql.="'".$dengenerica."',";
				$codcentro=$nreg[3];
				$sql.="'".$codcentro."',";
				$nombrecentro=$nreg[4];
				$sql.="'".$nombrecentro."',";
				
				$direccion=$this->limpiadato($nreg[5]);
				$sql.="'".$direccion."',";

				$codpostal=$nreg[6];
				$sql.="'".$codpostal."',";
				$provincia=$nreg[7];
				$sql.="'".$provincia."',";
				$municipio=$nreg[8];
				$sql.="'".$municipio."',";
				$nalumnos=$nreg[9];
				$sql.="'".$nalumnos."')";
				//print($sql);exit();
				if(!$result = mysqli_query($this->conexion,$sql))
				{
					die("\nCONSULTA: $sql Error:".mysqli_error($this->conexion));
				}
				$numero_registros++;

			}
		}
	return $numero_registros;
	}
	public function limpiadato($r)
	{
		$r=str_replace("'","",$r);
		$r=str_replace(";","",$r);
		$r=str_replace("\"","",$r);
	return $r;
	}

  public function genStatsInmigracion($sep,$curso)
	{
	//CARGAMOS DATOS EN LA TABL ESPECIFICADA. LOS CAMPOS DEL CSV SIGUEN EL ORDEN DE LA ESTRUCTURA DE LA TABLA
		$numero_registros=0;
				
		$sql1="UPDATE stats_centros SET pctextranjeros=nextranjeros/nalumnos*100 WHERE nalumnos>0";
		if(!$result = mysqli_query($this->conexion,$sql1 ))
			{
				die($sql1."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
			}
		$sql1="UPDATE stats_comarcas SET pctextranjeros=nextranjeros/nalumnos*100 WHERE nalumnos>0";
		if(!$result = mysqli_query($this->conexion,$sql1 ))
			{
				die($sql1."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
			}
		print($sql1);
	return $numero_registros;
	}
  public function genStatsMatriculaComarcas($sep,$curso)
	{
	//CARGAMOS DATOS DE MARICULA ABSOLUTA Y NUM DE EXTRANJEROS POR COMARCAS
		$numero_registros=0;
				
		$sql="select distinct(comarca) from base_centros";
		$gresult = mysqli_query($this->conexion,$sql );
	
		while($reg=$gresult->fetch_row())
		{
			$idstats=$this->checkComarcaStats($curso,$reg[0]);
			if($idstats==0) 
			{
				$insert="INSERT INTO stats_comarcas(comarca,curso) VALUES('$reg[0]','$curso')";
				if(!$result = mysqli_query($this->conexion,$insert ))
						die("\n $insert Error:".mysqli_error($this->conexion));
			
			}
			$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e,base_centros bc where bc.codcentro=e.codcentro and curso_escolar='$curso' and modalidad='Total' and comarca='$reg[0]'";
			$sql0="UPDATE stats_comarcas SET nalumnos=($cupdate) WHERE curso='$curso' and comarca='".$reg[0]."'";

			if(!$result = mysqli_query($this->conexion,$sql0 ))
				die($sql0."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
			$numero_registros++;
			$cupdate="select ifnull(sum(sc.nextranjeros),0) from base_centros bc,stats_centros sc where bc.codcentro=sc.codcentro and sc.curso='$curso' and comarca='$reg[0]'";
			$sql0="UPDATE stats_comarcas SET nextranjeros=($cupdate) WHERE curso='$curso' and comarca='".$reg[0]."'";
			print($sql0);exit();
			if(!$result = mysqli_query($this->conexion,$sql0 ))
					die($sql0."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
		}
		return $numero_registros;
	}
  public function genStatsMatriculaCentros($tabla,$sep,$curso)
	{
	//CARGAMOS DATOS EN LA TABL ESPECIFICADA. LOS CAMPOS DEL CSV SIGUEN EL ORDEN DE LA ESTRUCTURA DE LA TABLA
		$numero_registros=0;
				
		$sql="select distinct(codcentro) from base_centros";
		$gresult = mysqli_query($this->conexion,$sql );
	
		while($reg=$gresult->fetch_row())
		{
			//if($reg[0]!=50601547)
			//continue;
			$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql0="UPDATE $tabla SET nalumnos=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";

				if(!$result = mysqli_query($this->conexion,$sql0 ))
					{
						die($sql0."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
					}
			$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where cod_enseñanza_agrupada='INFANTIL' and e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql1="UPDATE $tabla SET nalei=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql1 ))
					{
						die($sql1."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
					}
				$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where cod_enseñanza_agrupada='PRIMARIA' and e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql2="UPDATE $tabla SET nalep=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql2 ))
					{
						die($sql2."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}

				$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where cod_enseñanza_agrupada='ESO' and e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql3="UPDATE $tabla SET naleso=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql3 ))
					{
						die($sql3."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				
				$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where cod_enseñanza_agrupada='BACHILLERATO' and e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql4="UPDATE $tabla SET nalbach=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql4))
					{
						die($sql4."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				
				$cupdate="select ifnull(sum(e.nalumnos),0) from sinee_matricula_centros_ensenanzas e where cod_enseñanza_agrupada IN('GRADO SUPERIOR','GRADO MEDIO','BASICA') and e.codcentro=$reg[0] and curso_escolar='$curso' and modalidad='Total'";
				$sql5="UPDATE $tabla SET nalfp=($cupdate),curso='$curso' WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql5))
					{
						die($sql5."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
					}
				$numero_registros++;
		}
	return $numero_registros;
	}
  public function checkComarcaStats($curso,$comarca)
	{
		$sql="select count(*) as nc from stats_comarcas where comarca like '%$comarca%' and curso='$curso'";
		if(!$result = mysqli_query($this->conexion,$sql))
						die($sql."\n Error:".mysqli_error($this->conexion));
		if(!$result->num_rows) 
		{
			die($sql.PHP_EOL);
		}
		else{
					 return $result->fetch_row()[0];
		}
	}
  public function checkCentro($nombre,$reg)
	{
		$centros=array("San Valero Escuelas Pías","Nuestra Señora del Pilar");
		//quitamos la primera palabra
		$nombre = preg_replace("/^(\w+\s)/", "", $nombre);
		$nombre=trim($nombre);
		$nombre=str_replace('  ',' ',$nombre);
		$nombre=str_replace('- ','-',$nombre);
		$nombre=str_replace(' -','-',$nombre);
		$nombre=addslashes($nombre);
		if(in_array($nombre,$centros)) return '44000261';
		if($nombre=='REYES CATÓLICOS') return '50001830';
		if($nombre=='H. ARGENSOLA') return '22000809';
		if($nombre=='DOMINGO MIRAL (2018-19)') return '22002727';
		if($nombre=='Nuestra Señora del Pilar') return '44002152';
		if($nombre=='PILAR BAYONA') return '50019299';
		if($nombre=='Maestrazgo-Gudar') return '44004316';
		if($nombre=='La Arboleda') return 44003259;
		if($nombre=='Diocesano Las Viñas') return 44003077;
		if($nombre=='Albardín') return 50011203;
		if($nombre=='Albada') return 50011321;
		if($nombre=='El Poyo del Cid') return -1;
		if($nombre=='ANA MARÍA NAVALES') return -1;

		$sql="select codcentro from base_centros where nombrecentro like '%$nombre%'";
		if(!$result = mysqli_query($this->conexion,$sql))
		{
						die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
		}
		if(!$result->num_rows) 
		{
			die($sql.PHP_EOL);
		}
		else return $result->fetch_row()[0];
	}
  public function updateBilingues($fcsvdata,$tabla,$sep)
	{
		$sql='nosql';
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
		{
			while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
			{
				if($numero_registros==0)
				{
					$numero_registros++;
					continue;
				}
				$reg=explode($sep,$linea[0]);
				$codcentro=$reg[2];
				$lengua=$reg[4];
				$checkcentro=$this->checkCentro($reg[0],$reg);
				if($checkcentro==-1) {print("Centro inexistente:");print_r($reg);continue;}
				$sql="UPDATE $tabla SET bilingue='$lengua' WHERE codcentro='".$checkcentro."'";
				if(!$result = mysqli_query($this->conexion,$sql))
				{
					die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
				}
				$numero_registros++;
			}
		}
		return $numero_registros;
	}
  public function updateTablaServicioscomp($fcsvdata,$tabla,$sep)
	{
		$sql='nosql';
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
		{
			while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
			{
				if($numero_registros==0)
				{
					$numero_registros++;
					continue;
				}
				$reg=explode($sep,$linea[0]);
				$codcentro=$reg[2];
				$sql="UPDATE $tabla SET ";
				if($reg[23]=='Transporte') $cupdate="transporte=1";
				elseif($reg[23]=='Comedor') $cupdate="comedor=1";
				elseif(strpos($reg[23],"Apertura")!==FALSE) $cupdate="apanteshorario=1";
				else continue;

				$sql.=$cupdate."  WHERE codcentro='".$codcentro."'";
				//print($sql);exit();
				if(!$result = mysqli_query($this->conexion,$sql))
				{
					die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
				}
				$numero_registros++;
			}
		}
		return $numero_registros;
	}
  public function updateStatsCentros($fcsvdata,$tabla,$sep)
	{
		$sql='nosql';
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
			{
				while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
				{
				if($numero_registros==0)
					{
					$numero_registros++;
					continue;
					}
				$reg=explode($sep,$linea[0]);
				$sql="UPDATE $tabla SET nextranjeros=$reg[1]  "." WHERE codcentro='".$reg[0]."'";
				if(!$result = mysqli_query($this->conexion,$sql))
					{
						die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				$numero_registros++;
				}
			}
	return $numero_registros;
	}
  public function updateTablaTiemposescolares($fcsvdata,$tabla,$sep)
	{
		$sql='nosql';
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
			{
				while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
				{
				if($numero_registros==0)
					{
					$numero_registros++;
					continue;
					}
				$reg=explode($sep,$linea[0]);
				$checkcentro=$this->checkCentro($reg[0]);
				if($checkcentro)
					$sql="UPDATE $tabla SET tiempos_escolares=1  WHERE codcentro='".$checkcentro."'";
				elseif($checkcentro==0) {	print_r($checkcentro.'--'.$sql);exit();}
				else {print("Centro inexistente:");print_r($reg);}
				if(!$result = mysqli_query($this->conexion,$sql))
					{
						print_r($reg);
						die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				$numero_registros++;
				}
			}
	return $numero_registros;
	}
  public function update_tabla($fcsvdata,$tabla,$sep)
	{
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
			{
				while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
				{
				if($numero_registros==0)
					{
					$numero_registros++;
					continue;
					}
				$reg=explode($sep,$linea[0]);
				$sql="UPDATE $tabla SET zona='".$reg[2]."',comarca='".$reg[3]."' WHERE codcentro='".$reg[0]."'";
				//print_r($sql);exit();
				if(!$result = mysqli_query($this->conexion,$sql))
					{
						print_r($reg);
						die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				$numero_registros++;
				}
			}
	return $numero_registros;
	}
  public function load_tabla($fcsvdata,$tabla,$sep)
	{
	//CARGAMOS DATOS EN LA TABL ESPECIFICADA. LOS CAMPOS DEL CSV SIGUEN EL ORDEN DE LA ESTRUCTURA DE LA TABLA
		$numero_registros=0;
		if (($gestor = fopen($fcsvdata, "r")) !== FALSE) 
			{
				while (($linea = fgetcsv($gestor, 0, "\n")) !== FALSE) 
				{
				if($numero_registros==0)
					{
					$numero_registros++;
					continue;
					}
				//print_r($linea);exit();
				$reg=explode($sep,$linea[0]);
				$sql="INSERT INTO $tabla VALUES(";
				//print_r($reg);exit(a);
				$nval=0;
				foreach($reg as $r) 
				{
					if($nval>=7) break;;
					$r=str_replace("'","",$r);
					$r=str_replace(";","",$r);
					$r=str_replace("\"","",$r);
					$sql.="'".$r."',";
					$nval++;
				}
				$sql=substr($sql,0,-1);
				$sql=$sql.")";
				//print($sql);exit();
				if(!$result = mysqli_query($this->conexion,$sql))
					{
						print_r($reg);
						die($sql."\n Nmero de registro: $numero_registros, Error:".mysqli_error($this->conexion));
						
					}
				$numero_registros++;

			}
		}
	return $numero_registros;
	}
  public static function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, -2, $max_words));
   return $phrase;
	}  
}
 
?>
