<?php 
require 'inc/Header.php';

$h = new Prozigzig($probus);
?>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
    <?php require 'inc/Navbar.php';?>
      <!-- Page Header Ends-->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
       <?php require 'inc/Sidebar.php';?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3><?php echo $lang['Report_Data'];?></h3>
                </div>
               <div class="col-sm-6">
			   <?php 
				 if(isset($_SESSION['stype']))
	{

		if($_SESSION['stype'] == 'sowner')
		{
		    ?>
		    <div style="text-align:right"><a href="add_payout.php" class="btn btn-outline-primary-2x"><?php echo $lang['Click_To_Request_Payout'];?></a></div>
		    <?php 
		}
		else 
		{
			?>
				 
	<?php } }  ?>
			   </div>
              </div>
            </div>
			
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default">
		 <?php 
		 if($_SESSION['stype'] == 'sowner')
		{
			?>
			<div class="row">
             
          
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Bus'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "SELECT * FROM tbl_bus WHERE operator_id=" . $sdata["id"];
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                         <img src="images/dashboard/icon3.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			   <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Coupon'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						
						$query = "select * from  tbl_coupon where operator_id=".$sdata["id"];
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                         <img src="images/dashboard/icon3.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Earning_Not_include_selfbook'];?> <i class="fa fa-circle"> </i></p>
                        <h4><?php
	
	$query = "SELECT SUM((subtotal - (cou_amt + commission)) - ((subtotal - cou_amt) * ope_commission/100)) AS total_earning 
          FROM tbl_book 
          WHERE book_status='Completed' 
          AND operator_id=" . $sdata["id"] . " 
          AND user_type!='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_BookSelf_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	
	$query = "SELECT sum((subtotal) - (subtotal * ope_commission/100)) as total_earning FROM `tbl_book` where book_status='Completed' and operator_id=".$sdata["id"]." and user_type='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];
	
	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_BookSelf_Admin_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	
	$query = "SELECT sum(subtotal * ope_commission/100) as total_earning 
	          FROM `tbl_book` where book_status='Completed' 
	          and operator_id=".$sdata["id"]." and user_type='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_BookSelf_Paid_to_Admin_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 	
	$query = "SELECT sum(amt) as total_earning FROM `tbl_cash`
              where  operator_id=".$sdata["id"]."";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];
	
	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_BookSelf_Remain_to_Admin_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php $remain =$bs-$bss; echo number_format((float)($remain), 2, '.', '').$set['currency'];
	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Without_Bookself_Admin_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum(subtotal * ope_commission/100) as total_earning
              FROM `tbl_book` where book_status='Completed'
			  and operator_id=".$sdata["id"]."";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Earning'];?> <i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum((subtotal -(cou_amt+commission)) - ((subtotal -cou_amt) * ope_commission/100))
              as total_earning FROM `tbl_book` where book_status='Completed'
			  and operator_id=".$sdata["id"]."";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  
			  
			  <div class="col-sm-6 col-lg-3">
			  <a href="add_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Pending_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select sum(amt) as pen_payout from bus_payout_setting where status='pending' and operator_id=".$sdata["id"]."";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon17.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			    <div class="col-sm-6 col-lg-3">
			  <a href="add_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Completed_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select sum(amt) as pen_payout from bus_payout_setting where status='completed' and operator_id=".$sdata["id"]."";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon16.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  
			  </div>
			<?php 
			
		}
		else 
		{
		 ?>
            <div class="row">
             
           <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Banner'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from  tbl_banner";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon1.svg" style="width: 60px;">


                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['City'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 					
						$query = "select * from  tbl_city";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                         <img src="images/dashboard/icon2.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Bus'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php $query = "select * from  tbl_bus";
                        echo $count = $h->executeQuery($query);
						
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                         <img src="images/dashboard/icon3.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  
			  
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Facility'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php
						$query = "select * from  tbl_facility";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon4.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['FAQ'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php
						$query = "select * from  tbl_faq";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon5.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Payment_Gateway'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php
						$query = "select * from  tbl_payment_list";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon6.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Dynamic_Pages'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from  tbl_page";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon7.svg" style="width: 60px;">
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Users'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from tbl_user where user_type='USER'";
                        echo $count = $h->executeQuery($query);
						
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon8.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Agents'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php
						 $query = "select * from tbl_user where user_type='AGENT'";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon13.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Operator'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from tbl_bus_operator";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon13.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Earning_Not_Self_Book']; ?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum((subtotal -(cou_amt+commission)) - ((subtotal -cou_amt) * ope_commission/100)) as total_earning FROM `tbl_book` where book_status='Completed' and user_type!='Operator' ";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon14.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Bookself_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	
	$query = "SELECT sum((subtotal -(cou_amt+commission)) - ((subtotal -cou_amt) * ope_commission/100)) as total_earning FROM `tbl_book` where book_status='Completed' and user_type='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon14.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Agent_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	$query = "SELECT sum(commission) as total_earning FROM `tbl_book` where book_status='Completed'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Admin_Earning_Not_Bookself'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	
	$query = "SELECT sum((subtotal -cou_amt) * ope_commission/100) as total_earning FROM `tbl_book` where book_status='Completed' and user_type!='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Admin_Earning_Bookself'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum((subtotal -cou_amt) * ope_commission/100) as total_earning FROM `tbl_book` where book_status='Completed' and user_type='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];
	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Tax_Received_Not_BookSelf'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum(tax_amt) as total_earning FROM `tbl_book` where book_status='Completed' and user_type!='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];
	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class=" f-w-600 header-text-primary"><?php echo $lang['Total_Tax_Received_BookSelf'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum(tax_amt) as total_earning FROM `tbl_book` where book_status='Completed' and user_type='Operator'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon9.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  <a href="complete.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Earning'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
	
	$query = "SELECT sum((subtotal+tax_amt-cou_amt)) as total_earning FROM `tbl_book` where book_status='Completed'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['total_earning'])) {
    $bs = number_format((float)$sales['total_earning'], 2, '.', '');
}

echo $bs . $set['currency'];

	?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon15.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			   <a href="pending.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Pending_Tickets'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from tbl_book where book_status='Pending'";
                        echo $count = $h->executeQuery($query);
						
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon10.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  <a href="complete.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Completed_Tickets'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select * from tbl_book where book_status='Completed'";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon11.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  <a href="cancle.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Cancelled_Tickets'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php
						$query = "select * from tbl_book where book_status='Cancelled'";
                        echo $count = $h->executeQuery($query);
						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon12.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-lg-3">
			  <a href="list_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Agent_Pending_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php $query = "select sum(amt) as pen_payout from payout_setting where status='pending'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon17.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			    <div class="col-sm-6 col-lg-3">
			  <a href="list_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Agent_Completed_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select sum(amt) as pen_payout from payout_setting where status='completed'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon16.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  
			   <div class="col-sm-6 col-lg-3">
			  <a href="list_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Pending_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select sum(amt) as pen_payout from bus_payout_setting where status='pending'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon17.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			    <div class="col-sm-6 col-lg-3">
			  <a href="list_payout.php">
                <div class="card o-hidden">
                  <div class="card-header pb-0">
                    <div class="d-flex"> 
                      <div class="flex-grow-1"> 
                        <p class="square-after f-w-600 header-text-primary"><?php echo $lang['Total_Operator_Completed_Payout'];?><i class="fa fa-circle"> </i></p>
                        <h4><?php 
						$query = "select sum(amt) as pen_payout from bus_payout_setting where status='completed'";
		  $sales = $h->fetchData($query);
		  
		  $bs = 0;
if (!empty($sales['pen_payout'])) {
    $bs = number_format((float)$sales['pen_payout'], 2, '.', '');
}

echo $bs . $set['currency'];

						?></h4>
                      </div>
                      <div class="d-flex static-widget">
                        <img src="images/dashboard/icon16.svg" style="width: 60px;">

                      </div>
                    </div>
                  </div>
                  
                </div>
				</a>
              </div>
			  
			  
			
            
            </div>
		<?php } ?>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
       
      </div>
    </div>
    <!-- latest jquery-->
   <?php require 'inc/Footer.php'; ?>
    <!-- login js-->
  </body>


</html>