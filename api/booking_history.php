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
   
    $uid =  strip_tags($h->real_string($data['uid']));
	$status = $data['status'];
	$op = array();
	$vop = array();
	if($status == 'Pending')
	{
		$getbusinfo = $h->queryfire("SELECT id,ticket_price,boarding_city,drop_city,bus_picktime,bus_droptime,Difference_pick_drop,bus_id,subtotal,book_date FROM `tbl_book` where uid=".$uid." and book_status='Pending'");
	}
	elseif($status == 'Completed')
	{
		$getbusinfo = $h->queryfire("SELECT id,ticket_price,boarding_city,drop_city,bus_picktime,bus_droptime,Difference_pick_drop,bus_id,subtotal,book_date FROM `tbl_book` where uid=".$uid." and book_status='Completed'");
	}
	else 
	{
	$getbusinfo = $h->queryfire("SELECT id,ticket_price,boarding_city,drop_city,bus_picktime,bus_droptime,Difference_pick_drop,bus_id,subtotal,book_date FROM `tbl_book` where uid=".$uid." and book_status='Cancelled'");
	}
	while($row = $getbusinfo->fetch_assoc())
	{
		$businfo = $h->queryfire("SELECT * from tbl_bus where id=".$row["bus_id"]."")->fetch_assoc();
		
		$op['ticket_id'] = $row['id'];
		
		$op['bus_name'] = $businfo['title'];
		$op['bus_no'] = $businfo['bno'];
		$op['bus_img'] = $businfo['bus_img'];
		$op['is_ac'] = $businfo['bac'];
		$op['subtotal'] = $row['subtotal'];
		$op['book_date'] = $row['book_date'];
		$op['ticket_price'] = $row['ticket_price'];
		$op['boarding_city'] = $row['boarding_city'];
	    $op['drop_city'] = $row['drop_city'];
		$op['bus_picktime'] = $row['bus_picktime'];
		$op['bus_droptime'] = $row['bus_droptime'];
		$op['Difference_pick_drop'] = $row['Difference_pick_drop'];
		$vop[] = $op;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Book Ticket Successfully!!!","tickethistory"=>$vop);
}
echo json_encode($returnArr);