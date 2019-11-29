<!DOCTYPE html>
<?php
include 'db.php';
$formulaname=$_POST["formulaname"];
$query=$db -> prepare("select *from formulations ORDER BY id DESC LIMIT 1");
while ($row = $query ->fetch(PDO::FETCH_ASSOC)) {
    $formulaname .= $row['formulaname'];

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
        $ingredientlysine = $row['lysine'];
        $ingredientcalcium = $row['calcium'];
        $ingredientme = $row['me'];
        $ingredientprotein = $row['protein'];
        $ingredientprice = $row['price'];
        $ingredientfat = $row['fat'];
        $ingredientmethionine = $row['methionine'];
        $ingredientfiber = $row['fiber'];
        $ingredientphosphorous = $row['phosphorous'];


        ///creating constraints
        $vlysine[]=$ingredientlysine.$value.'+';
        $vcalcium[]=$ingredientcalcium.$value.'+';
        $vme[]=$ingredientme = $ingredientme.$value.'+';
        $vprotein[] = $ingredientprotein.$value.'+';
        $vprice[] =$ingredientprice.$value.'+';
        $vingredients[]=$value.'+';
        $vfat[]=$ingredientfat.$value.'+';
        $vmethionine[]=$ingredientmethionine.$value.'+';
        $vfiber[]=$ingredientfiber.$value.'+';
        $vphos[]=$ingredientphosphorous.$value.'+';



    }

}


$feedtype=$_POST["formulaname"];
$query = $db -> prepare("SELECT * FROM kebs_requirements WHERE feed_type=:feedtype");
$query ->execute([':feedtype' => $feedtype]);
$items=array();

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $lysine[] = $row['lysine'];
    $calcium[] = $row['calcium'];
    $me[] = $row['me'];
    $protein[] = $row['protein'];
    $fat[] = $row['fat'];
    $methionine[] = $row['methionine'];
    $fiber[] = $row['fiber'];
    $phosphorous[] = $row['phosphorous'];

}
$right[]=array_merge($protein,$calcium,$me,$lysine);
$value=implode('',$vlysine).'<='.implode('',$lysine)."<br>".
    implode('',$vcalcium).'<='.implode('',$calcium)."<br>".
    implode('',$vme).'<='.implode('',$me)."<br>".
    implode('',$vprotein).'<='.implode('',$protein)."<br>";
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Simplex Method Demo</title>
	<script src = "LPdefs.js"></script>
	<script src = "LPmethods.js"></script>
	<script>
		lp_reportErrorsTo=lp_reportSolutionTo="solutionout";
		var lp_demo_exampleNumber=0;
		var lp_demo_accuracy=6;
		var lp_demo_mode="decimal";
		var lp_demo_verboseLevel=lp_verbosity_none;
		var exampleStr = [
		"Maximize p = (1/2)x + 3y + z + 4w subject to \nx + y + z + w <= 40\n2x + y - z - w >= 10\nw - y >= 12"
		,
		"minimize z = 900x1 + 1400x2 + 700x3 + 1000x4 + 1700x5 + 900x6 subject to\nx1 + x2 + x3 <= 10\nx4 + x5 + x6 <= 10\nx1 + x4 >= 6\nx2 + x5 >= 4\nx3 + x6 >= 4\nx4 - x6 <= 0"
		,
		"minimise z = 70x1 + 125x2 + 450x3 + 15x4 + 45x5 + 32x6 + 850x7 + 500x8 + 40x9 + 350x10 + 𝑋11 + 50x12 Subject to \n" +
        "0.088X1+0.44X2+0.65X3+0.17X5+0.18X6 >= 0.20 \n" +
        " 0.04X1+0.035X2+0.045X3+0.035X5+0.06X6 >= 0.035  \n" +
        "0.02X1+0.065X2+0.01X3+0.085X5+0.12X6 >= 0.05 \n" +
        "0.0001X1+0.002X2+0.061X3+0.37X4+0.0014X5+0.21X6+0.35X8 >= 0.01 \n" +
        " 0.0009X1+0.002X2+0.03X3+0.003X5+0.0018X6 >= 0.0045\n" +
        "0.0025X1+0.028X2+0.045X3+0.009X5+0.0064X6+0.94X9 >= 0.01\n" +
        "0.0018X1+0.0059X2+0.018X3+0.0025X5+0.0039X6+1.00X7 ≥ 0.004\n" +
        "\n" +
        " \n" +
        "x1+x2+x3+x4+x5+x6+x7+x8+x9+x10+x11+x12>=0"
		]

		function showExamples() {
			document.getElementById("inputarea").value=exampleStr[lp_demo_exampleNumber%exampleStr.length];
			lp_demo_exampleNumber++;
		}

		function clearAll() {
			document.getElementById("inputarea").value="";
			document.getElementById("solutionout").innerHTML="An optimal solution (or message) will appear here.";
			document.getElementById("outputarea").innerHTML="The tableaus will appear here if desired.";
		}

		function clearOutput() {
			document.getElementById("outputarea").innerHTML="The tableaus will appear here if desired.";
		}
		
		function showOutput( str ) {
			document.getElementById("outputarea").innerHTML = str;
		}
		
		function showSolution( str ) {
			document.getElementById("solutionout").innerHTML = str;
		}

		function adjustAccuracy() {
			var inAcc=parseInt(document.getElementById("accuracyDig").value);
			if ( (inAcc<=0)||(inAcc>13)||(isNaN(inAcc)) ) {
				alert("Must be in integer in the range 0-13")
				document.getElementById("accuracyDig").value=6;
			}
			else lp_demo_accuracy = inAcc;
		}

		function setMode() {
			lp_demo_mode=parseInt(document.querySelector('input[name="modepicker"]:checked').id); // ids are conveniently set to equal the mode
		}

		function setShowTabl() {
			var theId = document.querySelector('input[name="displaytabl"]:checked').id;
			switch ( theId ) {
				case "yesTabl":		lp_demo_verboseLevel = lp_verbosity_tableaus; break;
				case "andSolns":	lp_demo_verboseLevel = lp_verbosity_solutions; break;
				default:			lp_demo_verboseLevel = lp_verbosity_none; break;
			}
// 			lp_demo_verboseLevel = (theId=="yesTabl") ? lp_verbosity_tableaus : lp_verbosity_none;
		}
	</script>
</head>

<body>

	<div id = "container" style="width:100%;border:thin black solid;background-color:#dddddd;font-size:12px">
		<div id="info1" style="width:100%;text-align:center;margin:5px 0 5px 0">
			<?php
            echo 'ken'
			?>
		</div>
		<center>
			<div id="input">
			<textarea rows="15" cols="15" id="inputarea" style="width:95%">
                <?php
                ini_set( "display_errors", 0);
                include '../simplex-solver-2016-11-19/data.php';


                echo 'minimise z= '. implode('',$vprice).' subject to';
                echo"\n";
                echo implode('',$vlysine).' >= '.implode('',$lysine);
                echo"\n";
                echo implode('',$vcalcium).' >= '.implode('',$calcium);
                echo"\n";
                echo implode('',$vme).' >= '.implode('',$me);
                echo"\n";
                echo implode('',$vprotein).' >='.implode('',$protein);
                echo"\n";
                echo implode('',$vfat).' <='.implode('',$fat);
                echo"\n";
                echo implode('',$vmethionine).' >='.implode('',$methionine);
                echo"\n";
                echo implode('',$vphos).' >='.implode('',$phosphorous);
                echo"\n";
                echo implode('',$vfiber).' <='.implode('',$fiber);
                echo"\n";


                echo implode('',$vingredients).' >= 1000';
                foreach ($ingredient as $row){
                    echo $row.' >= 10';
                    echo "\n";
                }

                ?>
            </textarea>
			</div>
			<div id="info2" style="width:100%;text-align:center;margin:5px 0 5px 0">
				Solution:
			</div>
			<div id="solutionout" style="text-align:left;background-color:white;width:95%;font-family:monospace;border:thin solid;padding:10px">
				An optimal solution (or message) will appear here.
			</div>
			<div id="buttonsdiv" style="width:100%;text-align:center;margin:5px 0 5px 0">
				<input type="button" value="Solve" 
				onClick="clearOutput();
					adjustAccuracy();setMode();setShowTabl();
					var Q = new lpProblem( document.getElementById('inputarea').value );
					lp_verboseLevel=lp_demo_verboseLevel;
					Q.mode=lp_demo_mode;
					Q.sigDigits=lp_demo_accuracy;
					try{Q.solve()}
					finally{showOutput( lp_trace_string );showSolution( Q.solutionToString() );}
				">
					&#160; &#160;
				<input type="button" value="Examples" onClick="showExamples();">
					&#160; &#160;
				<input type="button" value="Erase everything" onClick="clearAll();">
				
				<br>&#160;<br>
				
				<div style="display: inline-block; vertical-align:middle; text-align:left">
					<input type="radio" name="displaytabl" id="noTabl"> Hide tableaus.
					<br>
					<input type="radio" checked="true" name="displaytabl" id="yesTabl"> Show tableaus (slower).
					<br>
					<input type="radio" name="displaytabl" id="andSolns"> Show tableaus and intermediate solutions.
				</div>
				&#160; &#160; 
				Tableau mode: <div style="display: inline-block; vertical-align:middle; text-align:left">
					<input type="radio" checked="true" name="modepicker" id="3" value="decimal"> decimal
					<br>
					<input type="radio" name="modepicker" id="2" value="fraction"> fraction
					<br>
					<input type="radio" name="modepicker" id="1" value="integer"> integer
				</div>
					&#160; &#160;
				Rounding: <input type="text" id="accuracyDig" size="1" value="6"> significant digits
					&#160; &#160;
			</div>
			<div id="outputarea" style="width: 95%; overflow-x: scroll; background-color:white; font-family:monospace; border: thin solid; padding: 10px; text-align:left">
				The tableaus will appear here if desired.
			</div>
			<div id="spacer" style="height:20px"></div>
		</center>
	</div>
</body>
</html>
