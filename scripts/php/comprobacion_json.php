<?php

$pfile=$argv[1];
#$pfile="nuevo6.json";
if(file_exists($pfile)) {
			$cuali=json_decode(file_get_contents($pfile),true);
			var_dump($cuali);	
}
else print("json erroneo");
?>
