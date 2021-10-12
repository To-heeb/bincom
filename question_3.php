<?php
include "bincom_classes.php";

//Instantiating object of class Result
$resultObject = new Result;
//calling of fetchAllWards method
$output = $resultObject->fetchAllWards();
if (isset($_POST['new_polling_unit'])) {
//Instantiating object of class Sanitize
$sanitizeInput = new Sanitize;

$wardInfo = $_POST['ward_info'];
$registered_user = $sanitizeInput->sanitizeInputs($_POST['registered_user']);
$polling_unit_id = $_POST['polling_unit_id'];
$polling_unit_number = "DT".$_POST['polling_unit_number'];
$polling_unit_name = $sanitizeInput->sanitizeInputs($_POST['polling_unit_name']);
$polling_unit_decription = $sanitizeInput->sanitizeInputs($_POST['poling_unit_decription']);

if (empty($wardInfo)) {
    $message1 = "<li>Please Select Ward Name</li>";
    $errors[] = $message1;
}
if (empty($registered_user)) {
    $message2 = "<li>Please fill Registered User field</li>";
    $errors[] = $message2;
}
if (empty($_POST['polling_unit_id'])) {
    $message3 = "<li>Please fill the Polling Unit Id field</li>";
    $errors[] = $message3;
}
if (empty($polling_unit_name)) {
    $message4 = "<li>Please fill the Polling Unit Name field</li>";
    $errors[] = $message4;
}
if (empty($polling_unit_number)) {
    $message4 = "<li>Please fill the Polling Unit Number field</li>";
    $errors[] = $message4;
}
if (empty($polling_unit_decription)) {
    $message5 = "<li>Please fill the Polling Unit Description field</li>";
    $errors[] = $message5;
}


if(empty($errors)) {

$ward_info = explode("-", $wardInfo);
$uniquewardid = $ward_info[0];
$lga_id = $ward_info[1];
$ward_id = $ward_info[2];

//calling of createNewPollingUnit method
$resultObject->createNewPollingUnit($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description, $registered_user);

}

// echo"<pre>";
// var_dump($_POST);
// echo"</pre>"; 
}

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
                    <h2 style="color: white; line-height: auto;" class="text-center">Bincom Preliminary test</h2>
                  </div>
               </div>
            </div>
        </div>
		<div class="row mt-4" style="min-height: 28rem;">
            <div class="offset-2 col-8">
                     <?php
                        if (!empty($errors)) {
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                            <?php
                            foreach ($errors as $key => $value) {
                                echo $value;
                            }
                            
                            ?>
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" arial-label="close">&times;</button>
                            </div>
                        <?php
                        }


                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                    ?>
                <fieldset>
					<legend>Create New Polling Unit</legend>
					<form method='post' action=''>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Ward Name</label>
                        <select type="number" class="form-control" id="inputEmail4" name='ward_info' >
                            <option value="">Select Your Ward</option>
                            <?php
                                if (isset($output)) {
                                    if (is_array($output)) {

                                    foreach ($output as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['uniqueid']."-".$value['lga_id']."-".$value['ward_id'];  ?>"><?php echo $value['ward_name']; ?></option>
                                    <?php
                                    }
                                    }
                                }
                            ?>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Registered User</label>
                        <input type="text" class="form-control" id="inputPassword4" name='registered_user' placeholder="Oyekola Toheeb">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Polling Unit Id</label>
                            <input type="number" class="form-control" id="inputAddress" placeholder="5" name="polling_unit_id" min='1'>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">Polling Unit Number</label>
                            <input type="number" class="form-control" id="inputAddress2" placeholder="18369" name="polling_unit_number" min='1000'>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="inputAddress2">Polling Unit Name</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Odogunyan" name="polling_unit_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">Polling Unit Description</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Odogunyan Primary School" name="poling_unit_decription">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control" disabled>
                            <option selected>Delta State</option>
                        </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name='new_polling_unit'>Register</button>
                </form>
				</fieldset>
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