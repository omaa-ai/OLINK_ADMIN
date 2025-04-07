<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
$query = "SELECT * FROM `tbl_setting`";
		  $set = $h->fetchData($query);
		  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"type Get Successfully!!","SMS_TYPE"=>$set['sms_type'],"otp_auth"=>$set['otp_auth']);

echo json_encode($returnArr);
?>