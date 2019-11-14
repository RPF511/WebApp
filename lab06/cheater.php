<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php
		
		if($_POST['name'] == "" or $_POST['id'] == "" or !isset($_POST["card_type"],$_POST["course"],$_POST["grade"]) or count($_POST["course"])==0 ){
			$wrongstat = "fill out the form completely";
		?>


		<?php

		} elseif (!preg_match('/^[a-zA-Z .\-]*$/', $_POST['name'])) { 
			$wrongstat = "provide a valid name";
		?>


		<?php

		} elseif (!preg_match("/^\d{16}$/", $_POST["card_number"]) or ($_POST["card_type"] == "visa" and $_POST["card_number"][0] != 4) or ($_POST["card_type"] == "master" and $_POST["card_number"][0] != 5)) {
			$wrongstat = "provide a valid credit card number";
		}
		?>

		<?php
		if($wrongstat != ""){ ?>
			<h1>Sorry</h1>
			<p>You didn't <?= $wrongstat?>. <a href="http://localhost/gradestore.html">Try again?</a></p>
		<?php
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		

		<ul> 
		<li>Name: <?= $_POST['name'] ?></li>
			<li>ID: <?= $_POST['id'] ?></li>
			<li>Course: <?= processCheckbox($_POST['course']) ?></li>
			<li>Grade: <?= $_POST['grade'] ?></li>
			<li>Credit Card: <?= $_POST['card_number'] ?> (<?=$_POST['card_type'] ?>)</li>
		</ul>
		
		
		<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$newloser = $_POST['name'].';'.$_POST['id'].';'.$_POST['card_number'].';'.$_POST['card_type'].'<br/>';
			file_put_contents($filename, $newloser, FILE_APPEND);
		?>
		
		<?php
			$file = file_get_contents($filename);
		?>
		<pre><?= $file?></pre>
		<?php
		}
		?>
		<?php
			function processCheckbox($names){
				$str="";
				$count = count($names);
				for($i=0;$i<$count;$i++){
					$str=$str.$names[$i];
					if($i != $count-1){
						$str=$str.", ";
					}
				}
				return $str;
			}
			function isvalidstr($name){
				if ($_POST[$p] == "") {
					$na = $_POST[$p];
					print "wrong $na";
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
		?>
		
	</body>
</html>