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
                  <h3><?php echo $lang['Sub_route_Drop_Point_List_Management'];?></h3>
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
											<th><?php echo $lang['Dropping_Point_Name'];?></th>
											<th><?php echo $lang['Bus_Total_Sub_Drop_Routes'];?></th>
												
												<th><?php echo $lang['Action'];?></th>
									</tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $h->queryfire("SELECT board_id, COUNT(*) as total_routes
FROM tbl_drop_sub_route
where operator_id=".$sdata['id']."
GROUP BY board_id");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
												<td>
                                                   <?php $citylist = $h->queryfire("SELECT bo.bus_id, bo.bpoint, bo.dpoint, bu.title, bu.bno, bo.id AS boaring_id, 
       c_d.title AS drop_city_name, c_b.title AS boarding_city_name, 
       bo.btime AS boarding_time, bo.dtime AS drop_time
FROM tbl_board_drop_points AS bo
JOIN tbl_bus AS bu ON bu.id = bo.bus_id
JOIN tbl_city AS c_b ON c_b.id = bo.bpoint
JOIN tbl_city AS c_d ON c_d.id = bo.dpoint
WHERE bo.id = ".$row['board_id']."")->fetch_assoc(); 
												   echo $citylist["title"].'('.$citylist['bno'].') ---> '.$citylist['boarding_city_name'].' To '.$citylist['drop_city_name'].'( Drop Time : '.date("g:i A", strtotime($citylist['dtime'])).')';
												   ?>
                                                </td>
                                                
                                               <td>
                                                    <?php $totalRoutes = $row['total_routes'];
    echo $totalRoutes . ' ' . ($totalRoutes === 1 ? 'Sub Route' : 'Sub Routes'); ?>
                                                </td>
                                                
                                               
												
                                                <td style="white-space: nowrap; width: 15%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                           <div class="btn-group btn-group-sm" style="float: none;">
										   <a href="add_drop_time.php?id=<?php echo $row['board_id'];?>" class="tabledit-edit-button" style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#79F9B4"/><path d="M22.5168 9.34109L20.6589 7.48324C20.0011 6.83703 18.951 6.837 18.2933 7.49476L16.7355 9.06416L20.9359 13.2645L22.5052 11.7067C23.163 11.0489 23.163 9.99885 22.5168 9.34109ZM15.5123 10.2873L8 17.8342V22H12.1658L19.7127 14.4877L15.5123 10.2873Z" fill="#25314C"/></svg></a>
										   </div>
                                           
                                       </div></td>
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


</html>