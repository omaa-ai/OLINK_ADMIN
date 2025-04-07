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
                  <h3><?php echo $lang['Page_Management'];?></h3>
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
                 <?php 
				 if(isset($_GET['id']))
				 {
					
					  $query = "select * from tbl_page where id=".$_GET['id'];
		  $data = $h->fetchData($query);
					 ?>

					 <form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
								
								<div class="form-group mb-3">
                                    
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Page_Title'];?></label>
                                   
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Page_Title'];?>" name="ctitle" value="<?php echo $data['title'];?>" aria-label="Username" aria-describedby="basic-addon1">
								  <input type="hidden" name="type" value="edit_page"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                </div>
								
                                    
                                   <div class="form-group mb-3">
                                   
                                        <label  for="inputGroupSelect01"><?php echo $lang['Select_Status'];?></label>
                                    
                                    <select class="form-control" name="cstatus" id="inputGroupSelect01" required>
                                        <option value=""><?php echo $lang['Select_Status'];?></option>
                                        <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>><?php echo $lang['Publish'];?></option>
                                        <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>><?php echo $lang['UnPublish'];?></option>
                                       
                                    </select>
                                </div>
								
								
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Page_Description'];?> </label>
									<textarea class="form-control cdesc" rows="5"  name="cdesc" style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							
                                    <button type="submit" class="btn btn-primary"><?php echo $lang['Edit_Page'];?></button>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  onsubmit="return postForm()">
								
								<div class="form-group mb-3">
                                    
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Page_Title'];?></label>
                                    
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Page_Title'];?>" name="ctitle" aria-label="Username" aria-describedby="basic-addon1">
								  <input type="hidden" name="type" value="add_page"/>
                                </div>
								
                                    
                                   <div class="form-group mb-3">
                                    
                                        <label  for="inputGroupSelect01"><?php echo $lang['Select_Status'];?></label>
                                    
                                    <select class="form-control" name="cstatus" id="inputGroupSelect01" required>
                                        <option value=""><?php echo $lang['Select_Status'];?></option>
                                        <option value="1"><?php echo $lang['Publish'];?></option>
                                        <option value="0"><?php echo $lang['UnPublish'];?></option>
                                       
                                    </select>
                                </div>
								
								
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Page_Description'];?></label>
									<textarea class="form-control cdesc" rows="5"  name="cdesc" style="resize: none;"></textarea>
								</div>
							
                                    <button type="submit" class="btn btn-primary"><?php echo $lang['Add_Page'];?></button>
                                </form>
				 <?php } ?>
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