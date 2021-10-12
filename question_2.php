<?php
include "bincom_classes.php";

//Instantiating object of class Result
$resultObject = new Result;
$state_id = 25;	
//calling of getAllLocalGovermentsFromSingleState method
$output1 = $resultObject->getAllLocalGovermentsFromSingleState($state_id);

if (isset($_POST['localGovermentSearch'])) {

	if (empty($_POST['lga_info'])) {
		$searchError = "<p class='form-text text-danger'>Select Local Government<p>";
	}else{
		$lga_info = $_POST['lga_info'];
		$lgaInfo = explode("-", $lga_info);
		$lga_id = $lgaInfo[0];
		$lga_name = $lgaInfo[1];
		//calling of getTotalResultFromLocalGovernment method
		$output2 = $resultObject->getTotalResultFromLocalGovernment($lga_id);
	}

	
// echo"<pre>";
// var_dump($_POST);
// echo"</pre>";
}



// echo"<pre>";
// var_dump($output1);
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
<div class="container-fluid" >
		<div class="head" style="background-color: #023041; ">
            <div  class="container-fluid">
               <div class="row" style="min-height: 80px;">
                  <div class="col-sm-12 mt-3">
				  <a href="index.php" style="color: white;"><i class="fas fa-home" style="size: 5;"></i>Home</a>
                    <h2 style="color: white; line-height: auto;" class="text-center">Bincom Preliminary test</h2>
                  </div>
               </div>
            </div>
         </div>
		<div style="min-height: 28rem;">
			<div class="row mt-5">
				<div class="offset-2 col-8">
					<?php

					if(isset($lga_name)){
					?>
					<h2>Result for <?php echo $lga_name; ?> LGA</h2>
					<?php
					}

					?>
					<form method="post" action=''>
					<div class="form-row">
						<div class="col">
						<input type="text" class="form-control" placeholder="Delta State" disabled>
						</div>
						<div class="col">
						<select  class="form-control" name="lga_info" onchange="">
							<option value="" id="lga_0">Select Local Goverment</option>
							<?php
								if (is_array($output1)) {
									$kounter = 0;
									foreach ($output1 as $key => $value) {
										$kounter++
										?>
										<option value="<?php echo $value['lga_id']."-".$value['lga_name'];?>" id="<?php echo "lga".$kounter?>"> <?php echo $value['lga_name']?> </option>
										<?php
									}
								}
							?>
						</select>

						</div>
						<div class="col">
						<input type="submit" value="Search" name='localGovermentSearch' class="form-control btn btn-primary">
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="row mt-2">
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
								if (isset($output2)) {
									if (is_array($output2)) {
										$kounter = 0;
										foreach ($output2 as $key => $value) {
											$kounter++;
											?>
											<tr> 	
												<td><?php echo $kounter; ?></td>
												<td><?php echo $value["party_abbreviation"]; ?></td>
												<td><?php echo $value["total_result"]; ?></td>
												<td></td>
											</tr>
										<?php
										}
									}else{
										?>
										<tr >
											<td colspan="3"><div class="alert alert-info">No result available for this Local Government</div></td>
										<tr>
		
										<?php
									}
								}else{
									?>
										<tr >
											<td colspan="3"><div class="alert alert-info">Search For Local Goverment Results</div></td>
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