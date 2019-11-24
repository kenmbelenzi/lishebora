<?php
include "setting.php";
include "data.php";
include "TSimplex.class.php";

$r = new TSimplex($leftdata,$rightdata,$zdata,$maxiterasi,$iscetak);

// IF $iscetak= false, initial in setting.php
$jlhvariabel=$r->jumlahstatement();
$varcelltarget=$r->varvalue();
$result=$r->result();

echo "Z=".$result."<br>";
for  ($i = 0; $i<=($jlhvariabel-1); $i++) {
	echo $varcelltarget[$i][0]."=".$varcelltarget[$i][1]; echo "<br>"; 
}


?>