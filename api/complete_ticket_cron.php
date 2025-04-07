<?php 
require 'Prozigzig.php';
$h = new Prozigzig($probus);
$timestamp = date("Y-m-d H:i:s");

         $booklist = $h->queryfire("select * from tbl_book where book_status='Pending' and bus_drop_date<='".$timestamp."'");
         while($row = $booklist->fetch_assoc())
         {
             
        $id = $row["id"];
        $uid = $row["uid"];
        
         
		 $table = "tbl_book";
            $field = ["book_status" => 'Completed'];
            $where = "where id=" . $id . "";
            
            $check = $h->updateData_Api($field, $table, $where);
           
            $checkcomplete = $h->queryfire("select * from tbl_book where uid=".$uid." and book_status='Completed'")->num_rows;
            if($checkcomplete == 1)
	{
	    
	    
		$fin = $set['rcredit'];
	$uinfo = $h->queryfire("select * from tbl_user where id=".$uid."")->fetch_assoc();
	$refercode = $uinfo['refercode'];
	if(!empty($refercode))
	{
		$getm = $h->queryfire("select * from tbl_user where code=".$refercode."")->fetch_assoc();
		$fuid = $getm['id'];
		
		$table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$fuid",'Refer User Credit Added!!','Credit',"$fin","$timestamp");
  
  
	  $checks = $h->insertData_Api($field_values,$data_values,$table);
	  
		$h->queryfire("update tbl_user set wallet= wallet+".$fin." where code=".$refercode."");
		
	  
	}
	
	}
       
       $udata = $h->queryfire("select name from tbl_user where id=" . $uid . "")->fetch_assoc();
         $name = $udata['name'];

         $content = [
             "en" => $name . ', Your Book Trip #' . $book_id . ' Has Been Completed.',
         ];
         $heading = [
             "en" => "Trip Completed!!",
         ];

         $fields = [
             'app_id' => $set['one_key'],
             'included_segments' => ["Active Users"],
             'filters' => [['field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => $uid]],
             'contents' => $content,
             'headings' => $heading
         ];
         $fields = json_encode($fields);

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
         curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . $set['one_hash']]);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HEADER, false);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

         $response = curl_exec($ch);
         curl_close($ch);
         
         }
        
            