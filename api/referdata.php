<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{ 
$count = $h->queryfire("select * from tbl_user where id=".$uid."")->num_rows;
if($count != 0)
{
$wallet = $h->queryfire("select * from tbl_user where id=".$uid."")->fetch_assoc();
$curr = $h->queryfire("select scredit,rcredit from tbl_setting")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Balance Get Successfully!","code"=>$wallet['code'],"signupcredit"=>$curr['scredit'],"refercredit"=>$curr['rcredit']);
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Not Exist User!");
}
}
echo json_encode($returnArr);

