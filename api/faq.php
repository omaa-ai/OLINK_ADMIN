<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $uid = strip_tags(mysqli_real_escape_string($bus,$data['uid']));
    
    
$check = $h->queryfire("select * from tbl_faq where status=1");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
$returnArr = array("FaqData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Faq List Get Successfully!!");
}
echo json_encode($returnArr);