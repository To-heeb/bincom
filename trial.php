<?php
include "bincom_constant.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--required meta tags-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--Animate.css Stylesheet-->
	<link href="animate.css" type="text/css" rel="stylesheet">
	<!--Bootstrap Stylesheet-->
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	<!--Fontawesome Stylesheet-->
	<link href="fontawesome/css/all.css" type="text/css" rel="stylesheet">
	<!--External Stylesheet-->
	<link rel="stylesheet" type="text/css" href="">
	<!--Internal Stylesheet-->
	<style type="text/css">
		
	</style>
</head>
</head>
<body>
	<div class="container-fliud p-2">
		<div class="row">
			<div class="col">
                Welcome To  Bincom Polling Result search
			</div>
		</div>
		
		<div class="row text-center" style="height: 200px;">
			<div class="col" >
				<h3 style="line-height: 200px;">SEARCH ELECTION RESULT</h3>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-3">
				<a href="question_1.php" class="btn btn-primary">Search Result by State</a>
			</div>
			<div class="col-3">
			<a href="question_2.php" class="btn btn-primary">Search Result by State</a>
			</div>
			<div class="col-3">
			<a href="question_3.php" class="btn btn-primary">Add Polling Unit</a>
			</div>
		</div>
		<footer class="text-center mt-5">
			<p><?php echo APPNAME ?> Developed by <a href='https://toheeboyekola.com' target='_blank' style="color: black;">Oyekola Toheeb</a></p>
		</footer>
	</div>
	<!--Javascript Files jquery, popper, bootstrap-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" language="javascript">
		"use strict"
		$(document).ready(function(){
			
		})
	</script>
</body>
</html>