<?php
include "setting.php";

include "TSimplex.class.php";

/* SIMPLE SIMPLEX SOLVER CODES
created by Donni Ansyari

Contoh Kasus :

The owner of a shop producing automobile trailers wishes to determine the best mix for
his three products: flat-bed trailers, economy trailers, and luxury trailers. His shop is limited to working 24
days/month on metalworking and 60 days/month on woodworking for these products. The following table
indicates production data for the trailers

Let the decision variables of the problem be:
x1 =Number of flat-bed trailers produced per month,
x2 =Number of economy trailers produced per month,
x3 =Number of luxury trailers produced per month.
Assuming that the costs for metalworking and woodworking capacity are fixed, the problem becomes:
Maximize z = 6x1 + 14x2 + 13x3

subject to:
1/2 x1 + 2x2 + x3 <= 24,
x1 + 2x2 + 4x3 <= 60,
x1 >= 0, x2 >= 0, x3 >= 0.

Letting x4 and x5 be slack variables corresponding to unused hours of metalworking and woodworking
capacity, the problem above is equivalent to the linear program

Maximize z = 6x1 + 14x2 + 13x3,

subject to:

1/2 x1 + 2x2 + x3 + x4 = 24,
x1 + 2x2 + 4x3 + x5 = 60

xj >= 0 (j = 1, 2, . . . , 5).

The third row represents the z-equation, which may be rewritten as:
(−z) + 6x1 + 14x2 + 13x3 = 0.

By convention, we say that (−z) is the basic variable associated with this equation. Note that no formal
column has been added to the tableau for the (−z)-variable.


						Usage per unit of trailer	Resource Availabilities
						Flat-bed	Economy	  Luxury
Metalworking days		   1/2  	2			1		24
Woodworking days			1		2			4		60
Contribution ($ x 100)		6		14			13
----------------------------------------------------------------------------

Number of Trailers produced per month
Flat-bed	Economy		Luxury
	36			0		  6						<- Changing Cell
--------------------------------------

Constraints
24	<=	24	Metalworking days is limited to 24 days/month			<- Subject to constraint
60	<=	60	Woodworking days is limited to 60 days/month

Total Contribution ($ x 100)
294      <- Target Cell

*/


//TEST DATA 1:
include 'db.php';
$formulaname=$_POST["formulaname"];
$query=$db -> prepare("select *from formulations ORDER BY id DESC LIMIT 1");
while ($row = $query ->fetch(PDO::FETCH_ASSOC)) {
    $formulaname= $row['formulaname'];

}

$query = $db -> prepare("SELECT * FROM formulations WHERE formulaname=:formulaname");

$query ->execute([':formulaname' => $formulaname]);
$items=array();

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $ingredient[] = $row['ingredient'];
    $quantity[]= $row['quantity'];
    $price[] =$row['price'];


}

//getting ingredient nutritional components
foreach ($ingredient as $value) {
    $query = $db->prepare("SELECT * FROM raw_materials WHERE ingredient=:ingredient");
    $query->execute([':ingredient' => $value]);
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $ingredientlysine[] = $row['lysine'];
        $ingredientcalcium[] = $row['calcium'];
        $ingredientme[] = $row['me'];
        $ingredientprotein[] = $row['protein'];


    }
}


$feedtype='chick';
$query = $db -> prepare("SELECT * FROM kebs_requirements WHERE feed_type=:feedtype");
$query ->execute([':feedtype' => $feedtype]);
$items=array();

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $lysine[] = $row['lysine'];
    $calcium[] = $row['calcium'];
    $me[] = $row['me'];
    $protein[] = $row['protein'];

}
$right=array_merge($protein,$calcium,$me,$lysine);

$leftdata=array
(

    $ingredientprotein,//protein req
    $ingredientcalcium,//calcium
    $ingredientme,//me
    $ingredientlysine,//lysine
    array(1,1)


);  // equation to left

$rightdata=$right; //value to right <- Subject to constraint

$zdata=$price ;// MAx or min equation



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