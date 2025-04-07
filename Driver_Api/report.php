<?php 
require dirname( dirname(__FILE__) ).'/api/Prozigzig.php';
$h = new Prozigzig($probus);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['bus_id'] == '' or $data['driver_id'] == '' or $data['comment'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $bus_id = strip_tags($h->real_string($data['bus_id']));
    $driver_id = strip_tags($h->real_string($data['driver_id']));
    $comment = strip_tags($h->real_string($data['comment']));
    $report_date = date("Y-m-d H:i:s");
	
	$table="tbl_report";
  $field_values=array("bus_id","driver_id","comment","report_date");
  $data_values=array("$bus_id","$driver_id","$comment","$report_date");
	  $check = $h->insertData_Api($field_values,$data_values,$table);
	  
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Report Done Successfully!");
}
echo json_encode($returnArr);
?>
    