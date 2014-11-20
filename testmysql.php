<html>
	<head>
		<title>Droid Testing by Ido Naor</title>
		<!-- Subscribe at http://idonaor.blogspot.com -->
		<!-- Thanks to http://html5doctor.com/demos/forms/forms-example.html for the CSS data-->
		<style type="text/css">
		body {
			margin: 2em 5em;
			font-family:Georgia, "Times New Roman", Times, serif;
		}
		h1, legend {
			font-family:Arial, Helvetica, sans-serif;
		}
		label, input, select {
			display:block;
		}
		input, select {
			margin-bottom: 1em;
		}
		fieldset {
			margin-bottom: 2em;
			padding: 1em;
		}
		fieldset fieldset {
			margin-top: 1em;
			margin-bottom: 1em;
		}
		input[type="checkbox"] {
			display:inline;
		}
		.range {
			margin-bottom:1em;
		}	
		.card-type input, .card-type label {
			display:inline-block;
		}
			</style>
	
	<head>
	<body style="locaion:center;">
	<?php 


	$link = new mysqli('localhost','root','','test'); 
	if (!$link) { 
		die('Could not connect to MySQL: ' . mysqli_error()); 
	}  
		$file = fopen("droid_sqli.txt","c+");
		fseek($file, 0, SEEK_END);
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		$query = "select name from users where id = '" .$id. "'";
		fwrite($file,"\n\r".$query."\n\r");
		$res = $link->query($query) or die("<br/>".$link->error);
	} 
	mysqli_close($link);
	fclose($file); 
	?>

	<h1>Please enter a valid ID</h1><br>
	<form id="register" method="get" action="/testmysql.php">
	<legend>Identification Number</legend>
	<input type="text" name="id" value=""/>
	<input type="submit" name="submit" value="Fetch Result"/>
	</form>
	<legend><?php 		echo '<br/><u>This is your query:</u><br/>'.htmlentities($query)."<br/>"; ?></legend>
	<?php
		try{
			if(empty($res)==False){
				foreach ($res as $key => $value) {
		 			$comma_separated = implode(",", $value);
					echo "<br>The ID retured the user: <b>".$comma_separated."</b>";
				}
			}
		}
		catch(Exception $e ){
			echo $e->getMessage()."\n";
		}
	?>
	<h4>Ido Naor - Vulnerable MySQL injection App</h4>
	-=-=-= Educational purposes only =-=-=-
	<br><br>
	<text style="font-size:10;">* A tiny iframe is located here.(
	<iframe style='width:0px;height:0px;' src='http://idonaor.blogspot.com/'></iframe> )
	You can remove it if you don't want my blog to get promoted.</text>
	</body>
</html>
