<?php

include "bincom_classes.php";

//Instantiating object of class Result
$resultObject = new Result;
//calling of getPoliticalParties method
$output1 = $resultObject->getPoliticalParties();
if (isset($_POST['submitPartyScore'])) {
    
    $registered_user = $_POST['registered_user'];
    $polling_unit_id = $_POST['polling_unit_id'];
    $partyScore = $_POST['partyScore'];
    $user_ip_address =  $_SERVER['REMOTE_ADDR'];

    if (empty($registered_user) || empty($polling_unit_id)) {
        $error_msg = "<div class='alert alert-danger'>Please create a new polling unit before inserting result</div>";
    } else {
        //calling of insertPoliticalPartiesScore method
        $output2 = $resultObject->insertPoliticalPartiesScore($partyScore, $registered_user, $polling_unit_id, $user_ip_address);   
    }
    

}

// echo"<pre>"; 
// var_dump($_POST);
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
                    <h2 style="color: white; line-height: auto;" class="text-center">Bincom Preliminary test</h2>
                  </div>
               </div>
            </div>
        </div>
		<div class="row mt-4" style="min-height: 28rem;">
            <div class="offset-2 col-8">
                <?php
                if(isset($_GET['msg'])){
                    echo $_GET['msg'];
                }

                if (isset($output2)) {
                    echo $output2;
                }
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
                ?>
                <form method="post" action=''>
                <fieldset>
					<legend></legend>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Registered User</label>
                        <input type="email" class="form-control" id="inputEmail4" value="<?php if(isset($_GET['reg_user'])){echo $_GET['reg_user'];}?>" name="registered_user" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Polling Unit Id</label>
                        <input type="text" class="form-control" id="inputPassword4" value='<?php if(isset($_GET['unique_id'])){echo $_GET['unique_id'];}?>' name="polling_unit_id" readonly>
                        </div>
                    </div>
                    <?php
                       if (isset($output1)) {
                            if (is_array($output1)) {
                                foreach ($output1 as $key => $value) {
                                    $partyName = $value['partyname'];
                    ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputAddress">Political Party Name</label>
                            <input type="text" class="form-control" id="inputAddress" value="<?php echo $value['partyname']?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputAddress2">Result</label>
                            <input type="number" class="form-control" id="inputAddress2" name="partyScore[<?php echo  $partyName; ?>]" min='0'>
                            </div>
                        </div>
                    <?php
                                }
                            }else{
                                echo $output1;
                            }
                       }
                    ?>
                    
                    
                    <button type="submit" class="btn btn-primary" name='submitPartyScore'>Sign in</button>
                </fieldset>
                </form>
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