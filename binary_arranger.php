<?php

function swap(&$a,$i,$j){
	$s = $a[$i-1];
	$a[$i-1] = $a[$j-1];
	$a[$j-1] = $s;
}

function findMax($a,$i){
	if (!isset($a[$i*2]))
		return $i*2;
	if ($a[$i*2-1] > $a[$i*2])
		return $i*2; 
	return $i*2+1;
}
$a = array(1,3,5,4,7,6);
$n = 6;

for ($i = $n; $i > 0; $i--){
	for ($j = round($n/2); $j > 0; $j--){
		echo $j." j<br/>";
		$k = $j;
		while ($k*2 <= $n){
			echo $k." k<br/>";
			$p = findMax($a,$k);
			echo $p." p<br/>";
			if ($a[$k-1] >= $a[$p-1])
				break;
			swap($a,$k,$p);
			echo $a[$k-1]." ".$a[$p-1]."<br/>";
			$k = $p;
		}
	}
	print_r($a); echo "<br/>";
	$b[$i] = $a[0];
	$a[0] = $a[$n-1];
	$a[$n-1] = 0;
	$n--;

}
print_r($b);