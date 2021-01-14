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
	$children2=$l3[2];

	if($nl==1)
	{
		$lf="[{".$lactual;
		$lf.=",\"children\":[{".$children1;
		$lant=$lactual;
		$lantchildren1=$children1;
		$lf.=",\"children2\":[{".$children2."}";
		continue;
	}
	if($lactual==$lant)
	{
		if($children1==$lantchildren1)
			$lf.=",{".$children2."}";
		else		
		{
			$lf.="]},{".$children1;
			$lf.=",\"children2\":[{".$children2."}";
		}
	}
	else
	{
    $lf.="]}]},{".$lactual.",\"children\":[{".$children1;
    $lf.=",\"children2\":[{".$children2."}";
	}
	$lant=$lactual;
	$lantchildren1=$children1;
}
fclose($handle);
$lf.="]}]}]";
print($lf);
