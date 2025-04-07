<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
$query = "SELECT * FROM `tbl_setting`";
		  $set = $h->fetchData($query);
header('Content-type: text/json');
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Agent Status Get Successfully!","agent_status"=>$set['agent_status']);
echo json_encode($returnArr);