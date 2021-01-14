<?php

$nl=0;
$lf='';
$fcsv=$argv[1];

$handle = fopen($fcsv, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
			$nl++;
			$line=str_replace("\n","",$line);
			$l2=$line;
			if($nl==1)
			{
				$lf="[{".$l2;
				continue;
			}
			$lf.="},{".$l2;
    }
		$lf.="}]";
		$lf=str_replace('""','"',$lf);
    fclose($handle);
} else {
	print("Error leyendo");
    // error opening the file.
} 
print($lf);
