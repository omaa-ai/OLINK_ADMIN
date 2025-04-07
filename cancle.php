<?php 
require 'inc/Header.php';
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
                  <h3><?php echo $lang['Total_Cancelled_Trip_Management'];?></h3>
                </div>
               
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default">
            <div class="row">
           <div class="col-sm-12">
                <div class="card">
				<div class="card-body">
				<div class="table-responsive">
                <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th><?php echo $lang['Sr_No'];?>.</th>
							
											<th><?php echo $lang['Bus_Image'];?></th>
											<th><?php echo $lang['Bus_Name'];?></th>
												<th><?php echo $lang['Total_Seat'];?></th>
												<th><?php echo $lang['Passenger_Name'];?></th>
												
												
												<th><?php echo $lang['Reject_Comment'];?></th>
												
												<th><?php echo $lang['Total'];?></th>
												
                          </tr>
                        </thead>
                        <tbody>
                           <?php 
										$city = $h->queryfire("SELECT * FROM `tbl_book` where book_status='Cancelled' order by id desc");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$busdata = $h->queryfire("SELECT * from tbl_bus where id=".$row['bus_id']."")->fetch_assoc();
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                
												
												
                                                <td class="align-middle">
                                                   <img src="<?php echo $busdata['bus_img']; ?>" width="70" height="80"/>
                                                </td>
												
												<td>
                                                    <?php echo $busdata['title']; ?>
                                                </td>
                                                
                                               <td>
                                                    <?php echo $row['total_seat']; ?>
                                                </td>
												
												
												
												
												<td>
                                                    <?php echo $row['name']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['comment_reject']; ?>
                                                </td>
												
												<td>
                                                    <b><?php 
													if($row['total'] == 0)
													{
														echo $row['wall_amt'].$set['currency'];
													}
													else 
													{
													echo $row['total'].$set['currency'];
													}
													?></b>
                                                </td>
												
												
												
												
                                                
												
                                                
										  
                                                </tr>
											<?php 
										}
										?>
                          
                        </tbody>
                      </table>
					  </div>
					  </div>
				 
                </div>
              
                
              </div>
            
            </div>
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

<style>
.star-icon {
    color: #ddd;
    font-size: 2em;
    position: relative;
}

.star-icon.full:before {
    text-shadow: 0 0 2px rgba(0,0,0,0.7);
    color: #FDE16D;
    content: '\2605'; /* Full star in UTF-8 */
    position: absolute;
    left: 0;
}

.star-icon.half:before {
    text-shadow: 0 0 2px rgba(0,0,0,0.7);
    color: #FDE16D;
    content: '\2605'; /* Full star in UTF-8 */
    position: absolute;
    left: 0;
    width: 50%;
    overflow: hidden;
}

@-moz-document url-prefix() { /* Firefox Hack :( */
  .star-icon {
    font-size: 50px;
    line-height: 34px;
  }
}
</style>
</html>