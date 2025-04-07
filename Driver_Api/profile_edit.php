<?php 
require dirname( dirname(__FILE__) ).'/api/Prozigzig.php';
$h = new Prozigzig($probus);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['password'] == '' or $data['driver_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags($h->real_string($data['name']));
   
    $mobile = strip_tags($h->real_string($data['mobile']));
     $password = strip_tags($h->real_string($data['password']));
	 
$driver_id =  strip_tags($h->real_string($data['driver_id']));
$checkimei = $h->queryfire("select * from tbl_driver where  `id`=".$driver_id."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Driver Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_driver";
  $field = array('driver_name'=>$name,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$driver_id."";
	  $check = $h->updateData_Api($field,$table,$where);
	  
            $c = $h->queryfire("select * from tbl_driver where  `id`=".$driver_id."")->fetch_assoc();
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);