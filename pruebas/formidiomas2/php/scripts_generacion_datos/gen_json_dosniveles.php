<?php
$nl=0;
$lf='';
$fcsv=$argv[1];

$handle = fopen($fcsv, "r");
while (($line = fgets($handle)) !== false) {
	$nl++;
	$line=str_replace("\n","",$line);
	$l2=$line;
	$l3=explode("-n-",$l2);

	$lactual=$l3[0];
	
	$children1=$l3[1];

	if($nl==1)
	{
		$lf="[{".$lactual;
		$lf.=",\"children\":[{".$children1."}";
		$lant=$lactual;
		continue;
	}
	if($lactual==$lant)
	{
		$lf.=",{".$children1."}";
	}
	else
	{
		$lf.="]},{".$lactual.",\"children\":[{".$children1."}";
	}
	$lant=$lactual;

}
fclose($handle);
$lf.="]}]";
$lf=str_replace('""','"',$lf);
print($lf);
