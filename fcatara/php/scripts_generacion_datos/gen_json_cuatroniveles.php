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
	$children3=$l3[3];

	if($nl==1)
	{
		$lf="[{".$lactual;
		$lf.=",\"children1\":[{".$children1;
		$lant=$lactual;
		$lantchildren1=$children1;
		$lantchildren2=$children2;
		$lf.=",\"children2\":[{".$children2;
		$lf.=",\"children3\":[{".$children3."}";
		continue;
	}
	if($lactual==$lant)
	{
		if($children1==$lantchildren1)
		{
			if($children2==$lantchildren2)
				$lf.=",{".$children3."}";
			else		
			{
				$lf.="]},{".$children2;
				$lf.=",\"children3\":[{".$children3."}";
			}
		}
		else		
		{
			$lf.="]}]},{".$children1;
			$lf.=",\"children2\":[{".$children2;
			$lf.=",\"children3\":[{".$children3."}";
		}
	}
	else
	{
    $lf.="]}]}]},{".$lactual.",\"children\":[{".$children1;
    $lf.=",\"children2\":[{".$children2;
		$lf.=",\"children3\":[{".$children3."}";
	}
	$lant=$lactual;
	$lantchildren1=$children1;
	$lantchildren2=$children2;
}
fclose($handle);
$lf.="]}]}]}]";
print($lf);
