<?php
    include "bincom_constant.php";

    #Begin Connection class definition
    class Connection{
        //member variable
        public $dbcon;
    
        //member construct functions/methods 
        function __construct(){
    
        //connect to database
        $this->dbcon = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);
        if ($this->dbcon->connect_error)  {
            //logging of error into a file
            $connection_errors = 'connection_errors.txt';
            $error_msg = "Connection Error of class Users ".$this->dbcon->connect_error."\n";
            file_put_contents($connection_errors, $error_msg, FILE_APPEND);
            die("Conneciton Failure: the reason for this is ".$this->dbcon->connect_error);
            }
        }
    }
    #End Connection class definition

    #Begin Result class definition
    class Result extends Connection{
        //method to display result for any individual polling unit
        function getIndividualPollingUnitResult($unique_id){
            //sql query
            $sql = "SELECT * FROM `announced_pu_results` WHERE polling_unit_uniqueid = '$unique_id'";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $individualPollingResult = 'fetch_result_error.txt';
                $error_msg = "Unable to get individual polling unit result because ".$this->dbcon->error."\n";
                file_put_contents($individualPollingResult, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			}
                return $rows;
            }else{
                return "<div class='alert alert-danger'>Polling Unit result unavailable, please chechk back later.</div>";
            }
    
        }

        //method to get polling unit from a state
        function getPollingUnit($state_id){
            //sql query
            $sql = "SELECT * FROM `polling_unit` RIGHT JOIN `lga` ON `polling_unit`.lga_id = `lga`.lga_id WHERE state_id = '$state_id' ORDER BY polling_unit_name";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $polling_unit_fetch_error = 'polling_unit_fetch_error.txt';
                $error_msg = "Unable to get polling unit name because ".$this->dbcon->error."\n";
                file_put_contents($polling_unit_fetch_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row;         
			}
                return $rows;
            }else{
                return "<div class='alert alert-danger'></div>";
            }
        }

        //method to get all local government from a state
        function getAllLocalGovermentsFromSingleState($state_id){
            //sql query
            $sql = "SELECT * FROM `lga` WHERE state_id = '$state_id'";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $lga_fetch_error = 'lga_fetch_error.txt';
                $error_msg = "Unable to fetch local governments because ".$this->dbcon->error."\n";
                file_put_contents($lga_fetch_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			}
                return $rows;
            }else{
                return "<div class='alert alert-danger'></div>";
            }
        }

        //method to get total summed result from a partcular local government
        function getTotalResultFromLocalGovernment($lga_id){
            //sql query
            $sql = "SELECT party_abbreviation, SUM(party_score) AS total_result FROM `announced_pu_results` JOIN `polling_unit` ON `announced_pu_results`.polling_unit_uniqueid = `polling_unit`.uniqueid WHERE lga_id = '$lga_id' GROUP BY party_abbreviation";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $lga_result_error = 'lga_result_error.txt';
                $error_msg = "Unable to get total result from local government because ".$this->dbcon->error."\n";
                file_put_contents($lga_result_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			}
                return $rows;
            }else{
                return "<div class='alert alert-danger'>Oops!, Unable to fetch local government result please try again later.</div>";
            }
        }

        //method to fetch All Wards
        function fetchAllWards(){
            //sql query
            $sql = "SELECT * FROM ward ORDER BY ward_name";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $fetch_ward_error = 'fetch_ward_error.txt';
                $error_msg = "Unable to fetch ward because ".$this->dbcon->error."\n";
                file_put_contents($fetch_ward_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			}
                return $rows;
            }else{
                return "<div class='alert alert-danger'>Unable to get Ward Information</div>";
            }
        }
        

        //method to create new polling unit
        function createNewPollingUnit($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description, $registered_user){
            //sql query
            $sql = "INSERT INTO polling_unit(polling_unit_id, ward_id, lga_id, uniquewardid, polling_unit_number, polling_unit_name, polling_unit_description, entered_by_user) VALUES('$polling_unit_id', '$ward_id', '$lga_id', '$uniquewardid', '$polling_unit_number', '$polling_unit_name', '$polling_unit_description', '$registered_user') ";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $create_polling_unit_error = 'create_polling_unit_error.txt';
                $error_msg = "Unable to create a new polling unit because because ".$this->dbcon->error."\n";
                file_put_contents($create_polling_unit_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($this->dbcon->affected_rows == 1){
                $unique_id = $this->dbcon->insert_id;
                $msg = "<div class='alert alert-success' id='msg1'>Polling Unit Successfully registered</div>";
                //redirect to party_new_result.php page
                header("Location: party_new_result.php?msg=$msg&unique_id=$unique_id&reg_user=$registered_user");
                exit;
                
            }else{
                return "<div class='alert alert-danger'>Polling Unit result unavailable, please chechk back later.</div>";
            }
        }

         //method to get all political parties
        function getPoliticalParties(){
            //sql query
            $sql = "SELECT * FROM party";
            //execution of query
            $result = $this->dbcon->query($sql);
            if ($this->dbcon->error) {
                //logging of error into a file
                $fetch_party_error = 'fetch_party_error.txt';
                $error_msg = "Unable to get all political parties because ".$this->dbcon->error."\n";
                file_put_contents($fetch_party_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($result->num_rows > 0){
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
            }
                 return $rows;
            }else{
                return "<div class='alert alert-danger'>Polling Unit result unavailable, please chechk back later.</div>";
            }
        }
        
         //method to insert political parties results
        function insertPoliticalPartiesScore($partyScore, $registered_user, $polling_unit_id, $user_ip_address){
            //looping the array of political party score to insert to database
            foreach ($partyScore as $key => $value) {
                if (empty($value)) {
                   continue;
                }
                 //sql query
                $sql = "INSERT INTO announced_pu_results  SET  polling_unit_uniqueid = (SELECT uniqueid FROM polling_unit WHERE uniqueid = '$polling_unit_id'), entered_by_user = '$registered_user', party_abbreviation = '$key', party_score = '$value', user_ip_address = '$user_ip_address'";
                //execution of query
                $result = $this->dbcon->query($sql);
             }
             if ($this->dbcon->error) {
                //logging of error into a file
                $upload_party_result_error = 'party_result_error.txt';
                $error_msg = "Unable to upload new polling unit with id '".$polling_unit_id."' results  because ".$this->dbcon->error."\n";
                file_put_contents($upload_party_result_error, $error_msg, FILE_APPEND);
                 return "<div class='alert alert-danger'>"."There is an error: ".$this->dbcon->error."</div>";
            }elseif($this->dbcon->affected_rows >= 1){
                 $msg1 = "<div class='alert alert-success' id='msg1'>Result successfully uploaded</div>";
                 //redirect to question_3.php page
                header("Location: question_3.php?msg=$msg1");
                exit;
            }else{
                return "<div class='alert alert-danger'>Result Insertion failed please try again later</div>";
            }

            
        }

    }
    #End Result class definition


    # Begin sanitize class definition
    class Sanitize{

	//Begin Sanitize input
	public function sanitizeInputs($data){
		$data = trim($data);
		$data = addslashes($data);
		$data = htmlspecialchars($data);

		return $data; 
	}	

	//End Sanitize input
    }
    # End sanitize class definition


?>