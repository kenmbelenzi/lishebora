<?php
/* SIMPLE SIMPLEX CODES CLASS (LINEAR PROGRAMMING) Versi 1.00
created by Donni Ansyari @ 2016
email : donni.ansyari@gmail.com
*/
error_reporting(0);

class TSimplex
{

public static $identitymatrix = array();
public static $identitymatrixnew = array();
public static $leftdata = array();
public static $leftdatanew = array();
public static $rightdata = array();
public static $rightdatanew = array();
public static $zdata = array();
public static $zdatanew = array();
public static $prtable = array();
public static $trleftdata=array();
public static $tabelinit=array();
public static $table=array(); 
public static $tableinitnew=array(); 
public static $tableold=array();
public static $varbasic=array();
public static $varbasicnew=array();
public static $varbasicold=array();
public static $ratio=array();
public static $getdatavertikal=array();
public static $varcelltarget=array();
public static $varvalue=array();
var $result,$hasil;
var $jumlahstatement;

function TSimplex($leftdata,$rightdata,$zdata,$maxiterasi,$iscetak)
{


function transposeData($data)
{
  $retData = array();
    foreach ($data as $row => $columns) {
      foreach ($columns as $row2 => $column2) {
          $retData[$row2][$row] = $column2;
      }
    }
  return $retData;
}


function printtable($prtable,$jlhrow,$jlhcol)
{

echo "<table border=1 width=\"750\" bordercolor=0 cellpadding=3 cellspacing=0 style=\"border:1px\">";
echo "<tr>";
for ($j = 0; $j<=$jlhcol-1; $j++) {
echo "<td >".$j."</td>";	
}
echo "</tr>";

for ($i = 0; $i<=$jlhrow-1; $i++) {
echo "<tr>";
	for ($j = 0; $j<=$jlhcol-1; $j++) {
		if ($i==0) echo "<td align=right class=\"detail_kiri\">";
		if ($i<>0) echo "<td align=right class=\"detail_kiri\">";
		echo "<font size=2><b>".$prtable[$i][$j]."</b></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red size=1>(".$i.",".$j.")".":</font>";	
		echo "</td>";
	}
echo "</tr>";
}

echo "</table><br>";
}

$leftdatanew=$leftdata; 
$trleftdata=transposeData($leftdata);
$jlhvar=count($trleftdata);  
$rightdatanew=$rightdata;
$jlhstatement=count($rightdata);  
$jlhdimmatrixid=$jlhstatement;

for ($i = 0; $i<=$jlhdimmatrixid-1; $i++) {
  for ($j = 0; $j<=$jlhdimmatrixid-1; $j++) {
	 if ($i==$j){ $identitymatrix[$i][$j]=1; 
	 } 
	 else { 
	 $identitymatrix[$i][$j]=0; 
	 }
  }
}

$identitymatrixnew=$identitymatrix;
$jlhdimmatidentitas=count($identitymatrix);
$jlhzdata=count($zdata);
$zdatanew=$zdata;
$lastkolom=$jlhvar+$jlhdimmatidentitas+2;

for ($i = 0; $i<=$jlhstatement-1; $i++) {
	$tableinit[$i][$lastkolom-1]=$rightdata[$i];
	for ($j = 0; $j<=$jlhvar; $j++) {
		$tableinit[$i][$j]=$leftdata[$i][$j];
	}
	$tableinit[$i][$jlhvar+$jlhdimmatidentitas]=0;
}

for ($i = 0; $i<=$jlhdimmatidentitas-1; $i++) {
	for ($j =0; $j<=$jlhdimmatidentitas-1; $j++) {
	$tableinit[$i][$j+$jlhvar]=$identitymatrix[$i][$j];
	}

}

for ($i = 0; $i<=$jlhvar-1; $i++) {
	$tableinit[$jlhstatement][$i]=-($zdata[$i]);
	$zdatanew[$i]=-($zdata[$i]);
}

for ($i =1; $i<=$jlhdimmatidentitas; $i++) {
	$tableinit[$jlhstatement][$i+$jlhvar-1]=0;
}

$tableinit[$jlhstatement][$jlhvar+$jlhdimmatidentitas]=1;
$tableinit[$jlhstatement][$jlhvar+$jlhdimmatidentitas+1]=0;
$table=$tableinit;
$tableinitnew=$tableinit;

$jlhvartext=0;
for ($i=0; $i<=$jlhstatement-1; $i++) {
	$varbasic[$i]=$i+$jlhvar; 
}

$varbasicnew=$varbasic;
$z=0; $zold=0; $selisih=0; 

for ($iterasi = 1; $iterasi<=$maxiterasi; $iterasi++) {
   
if ($iterasi==1) {
	if ($iscetak==true) {
	echo "Iterasi-".$iterasi."<br>";
	printtable($tableinitnew,$jlhstatement+1,$jlhvar+$jlhdimmatidentitas+2);
	}
}
else {
	if ($iscetak==true) {
	echo "Iterasi-".$iterasi."<br>";
	}

$minzc=min($zdatanew);  
$keyzc = array_search($minzc,$zdatanew); 
$varbarisbaru=$keyzc+1; 

for ($i = 0; $i<=$jlhstatement-1; $i++) {
	$valratio=$rightdatanew[$i]/$tableinitnew[$i][$keyzc];  
	if ($valratio<0) $ratio[$i]=abs($valratio);
	if ($valratio>=0) $ratio[$i]=$valratio;
}

$minratio=min($ratio);  
$keyratio = array_search($minratio,$ratio); 
$varbasicnew[$keyratio]=$keyzc;

for  ($i = 0; $i<=$jlhstatement; $i++) {
$getdatavertikal[$i]=$tableinitnew[$i][$keyzc];  
}

$position=$keyratio;  
for  ($j = 0; $j<=($jlhvar+$jlhdimmatidentitas+1); $j++) {
	$table[$position][$j]=$tableinitnew[$position][$j]/($getdatavertikal[$position]);  
}

for ($i = 0; $i<=($jlhstatement-1); $i++) {
  for  ($j = 0; $j<=($jlhvar+$jlhdimmatidentitas+1); $j++) {
	if ($i<>$position) {
		$table[$i][$j]=$tableinitnew[$i][$j]-($getdatavertikal[$i])*$table[$position][$j]; 
	}
  }
}

$zpos=$i;
for  ($j = 0; $j<=($jlhvar+$jlhdimmatidentitas+1); $j++) {
	$table[$zpos][$j]=$tableinitnew[$zpos][$j]-($getdatavertikal[$zpos])*$table[$position][$j];  //0-14*12=-168;
}

for  ($i = 0; $i<=($jlhvar-1); $i++) {
	$zdatanew[$i]=$table[$jlhstatement][$i];
}

for  ($i = 0; $i<=($jlhdimmatidentitas-1); $i++) {
	$rightdatanew[$i]=$table[$i][$jlhvar+$jlhdimmatidentitas+1];
}

for  ($i = 0; $i<=($jlhdimmatidentitas-1); $i++) {
	for  ($j = 0; $j<=($jlhvar-1); $j++) {	
	$leftdatanew[$i][$j]=$table[$i][$j+1];
	}
}

$tableinitnew=$table;

	if ($iscetak==true) {
	printtable($table,$jlhstatement+1,$jlhvar+$jlhdimmatidentitas+2);
	}

$z=$table[$i][$jlhvar+$jlhdimmatidentitas+1]; 
$selisih=$z-$zold;
if ($selisih==0) break;

$tableold=$table;
$zold=$z;

$varbasicold=$varbasicnew;
	
} 

}

for  ($i = 0; $i<=($jlhstatement-1); $i++) {

if ($varbasicold[$i]>2) $var="S".($varbasicold[$i]-2);
if ($varbasicold[$i]<=2) $var="X".($varbasicold[$i]+1);

$varcelltarget[$i][0]=$var;
$varcelltarget[$i][1]=$tableold[$i][$jlhvar+$jlhdimmatidentitas+1];
}

$hasil=abs($tableold[$zpos][$jlhvar+$jlhdimmatidentitas+1]);

	if ($iscetak==true) {
    echo "Result (target) : -Z =".-($hasil)." => Z=".$hasil."; di iterasi ke-".($iterasi-1)."<br>";
	}

if ($iscetak==true) {
	for  ($i = 0; $i<=($jlhstatement-1); $i++) {
	echo $varcelltarget[$i][0]."=".$varcelltarget[$i][1]; echo "<br>"; 
	}
	echo "<br>"; 
}

$this->result = $hasil;
$this->jumlahstatement=$jlhstatement;
$this->varvalue=$varcelltarget;

} // end Solve

 function result() {
   return $this->result;
 }

  function jumlahstatement() {
   return $this->jumlahstatement;
 }

  function varvalue() {
   return $this->varvalue;
 }

} //end class
?>

