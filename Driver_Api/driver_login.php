<?php 
require dirname( dirname(__FILE__) ).'/api/Prozigzig.php';
$h = new Prozigzig($probus);
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['email'] == ''  or $data['password'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $email = strip_tags($h->real_string($data['email']));
    $password = strip_tags($h->real_string($data['password']));
	
    
$chek = $h->queryfire("select * from tbl_driver where email='".$email."' and status = 1 and password='".$password."'");
$status = $h->queryfire("select * from tbl_driver where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $h->queryfire("select * from tbl_driver where  email='".$email."'  and status = 1 and password='".$password."'");
    $c = $c->fetch_assoc();
	
    $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
}
else
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Invalid Email Address or Password!!!");
}
}
else  
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Your profile has been blocked by the administrator, preventing you from using our app as a regular user.");
}
}

echo json_encode($returnArr);