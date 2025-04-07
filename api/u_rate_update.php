<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['ticket_id'] == ''   or $data['total_rate']==''  or $data['rate_text'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	
	$uid = $data['uid'];
	$ticket_id = $data['ticket_id'];
	$total_rate = $data['total_rate'];
	$rate_text = $h->real_string($data['rate_text']);
	 $timestamp    = date("Y-m-d");
	 $check_status = $h->queryfire("select * from tbl_book where uid=".$uid." and id=".$ticket_id." and book_status='Completed'")->num_rows;
	 if($check_status != 0)
	 {
	$table="tbl_book";
  $field = array('total_rate'=>$total_rate,'rate_text'=>$rate_text,'is_rate'=>"1",'review_date'=>$timestamp);
  $where = "where uid=".$uid." and id=".$ticket_id."";
	  $check = $h->updateData_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rate Updated Successfully!!!");
	 }
	 else 
	 {
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Trip Not Completed!!"); 
	 }
	  
}
echo json_encode($returnArr);