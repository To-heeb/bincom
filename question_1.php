<?php

include "bincom_classes.php";
// echo"<pre>";
// var_dump($_POST);
// echo"</pre>";
if (isset($_POST['localGovermentSearch'])) {
	$polling_unit_id = $_POST['pollingUnitId'];
}

$state_id = 25;
//Instantiating object of class Result 
$resultObject = new Result;
if (isset($_POST['pollingUnitSearch'])) {
	$pollingUnitId = $_POST['pollingUnitId'];
}

if (empty($pollingUnitId)) {
	$pollingUnitId = 8;
}

//calling of getIndividualPollingUnitResult method
$output = $resultObject->getIndividualPollingUnitResult($pollingUnitId);

//calling of getPollingUnit method
$select_polling_unit = $resultObject->getPollingUnit($state_id);

// echo"<pre>"; 
// var_dump($output);
// echo"</pre>";


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
	<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
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
	<div class="container-fluid">
		<div class="head" style="background-color: #023041;">
            <div  class="container-fluid">
               <div class="row" style="min-height: 80px;">
                  <div class="col-sm-12 mt-3">
				  	<a href="index.php" style="color: white;"><i class="fas fa-home" style="size: 5;"></i>Home</a>
                    <h2 class="text-center" style="color: white; line-height: auto;">Bincom Preliminary test</h2>
                  </div>
               </div>
            </div>
         </div>
		 <div style="min-height: 28rem;">
			<div class="row mt-4">
				<div class="offset-2 col-8">
					<form action="" method="post">
					<div class="form-row">
						<div class="col">
						<input type="text" class="form-control" placeholder="Delta State" disabled>
						</div>
						<div class="col">
						<select value='' class="form-control" name="pollingUnitId">
							<option value="" id="lga0">Select Polling Unit</option>
							<?php
								if (is_array($select_polling_unit)) {
									$kounter = 0;
									foreach ($select_polling_unit as $key => $value) {
										$kounter++;
										if (empty($value['polling_unit_name'])) {
											continue;
										}
										?>
										<option value="<?php echo $value['uniqueid']?>" id="<?php echo "lga".$kounter?>"> <?php echo $value['polling_unit_name']?> </option>
										<?php
									}
								}
							?>
						</select>
						</div>
						<div class="col">
						<input type="submit" value="Search" name='pollingUnitSearch' class="form-control btn btn-primary">
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="row mt-5">
				<div class=" offset-2 col-8 table-responsive">
					<table class="table table-light table-hover table-striped">
						<thead>
							<th>S/N</th>
							<th>Polical Party</th>
							<th>Total votes</th>
							<th></th>
						</thead>
						<tbody>
							<?php
								if (is_array($output)) {
									$kounter = 0;
									foreach ($output as $key => $value) {
										$kounter++;
										?>
										<tr>
											<td><?php echo $kounter; ?></td>
											<td><?php echo $value["party_abbreviation"]; ?></td>
											<td><?php echo $value["party_score"]; ?></td>
											<td></td>
										</tr>
									<?php
									}
								}else{
									?>
									<tr >
										<td colspan="3"><div class="alert alert-info">No result available for this Polling Unit</div></td>
									<tr>
	
									<?php
								}
							?>
						</tbody>
					</table>
					<?php

					?>
				</div>
			</div>
		 </div>
		<footer style="background-color: #AC751B;">
         <div class="container mt-5">
            <div class="row">
               <div class="col-12 text-center " style=" padding: 6px 0px; margin-top: 20px;" >
                  <p style="font-size: 18px; line-height: 22px; text-align: center; color: #fff;"><?php echo APPNAME ?> Developed by <a href='https://toheeboyekola.com' target='_blank' style="color: black;">Oyekola Toheeb</a></p>
               </div>
            </div>
         </div>
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