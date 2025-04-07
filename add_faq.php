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
                  <h3><?php echo $lang['FAQ_Management'];?></h3>
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
					 
					 
					  $query = "select * from tbl_faq where id=".$_GET['id'];
		  $data = $h->queryfire($query)->fetch_assoc();
					 ?>
					 <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Question'];?></label>
                                    
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Question'];?>" value="<?php echo $data['question'];?>" name="question" aria-label="Username" aria-describedby="basic-addon1">
                               
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Answer'];?></label>
                                    
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Answer'];?>" value="<?php echo $data['answer'];?>" name="answer" aria-label="Username" aria-describedby="basic-addon1">
                                <input type="hidden" name="type" value="edit_faq"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                    
                                        <label  for="inputGroupSelect01"><?php echo $lang['Select_Status'];?></label>
                                    
                                    <select  class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value=""><?php echo $lang['Select_Status'];?></option>
                                        <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>><?php echo $lang['Publish'];?></option>
                                        <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>><?php echo $lang['UnPublish'];?></option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary"><?php echo $lang['Edit_FAQ'];?></button>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Question'];?></label>
                                    
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Question'];?>"  name="question" aria-label="Username" aria-describedby="basic-addon1">
                            
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1"><?php echo $lang['Enter_Answer'];?></label>
                                    
                                  <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Answer'];?>"  name="answer" aria-label="Username" aria-describedby="basic-addon1">
                                <input type="hidden" name="type" value="add_faq"/>	
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                   
                                        <label  for="inputGroupSelect01"><?php echo $lang['Select_Status'];?></label>
                                    
                                    <select class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value=""><?php echo $lang['Select_Status'];?></option>
                                        <option value="1"><?php echo $lang['Publish'];?></option>
                                        <option value="0"><?php echo $lang['UnPublish'];?></option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary"><?php echo $lang['Add_FAQ'];?></button>
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