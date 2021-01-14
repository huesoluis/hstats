<?php

$pfile=$argv[1];
if(file_exists($pfile)) {
			$cuali=json_decode(file_get_contents($pfile),true);
			var_dump($cuali);	
}
else print("json erroneo");
?>
