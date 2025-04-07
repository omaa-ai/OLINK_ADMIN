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
                  <h3><?php echo $lang['Coupon_Management'];?></h3>
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
					 $data = $h->queryfire("select * from tbl_coupon where id=".$_GET['id']."")->fetch_assoc();
					 
					 ?>
					 <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Image'];?></label>
									
									<input type="hidden" name="type" value="edit_coupon"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
									<input type="file" name="coupon_img" class="form-control"  required>
									<br>
									<img src="<?php echo $data['coupon_img'];?>" width="100" height="100"/>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Expiry_Date'];?></label>
									<input type="date" name="expire_date" value="<?php echo $data['expire_date'];?>"  class="form-control"  required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
								
									<label for="cname"><?php echo $lang['Coupon_Code'];?> </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="coupon_code" required  value="<?php echo $data['coupon_code'];?>"  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_title'];?> </label>
									<input type="text"  class="form-control"  name="title" value="<?php echo $data['title'];?>"required >
								</div>
							</div>
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_subtitle'];?> </label>
									<input type="text"  class="form-control"  name="subtitle" value="<?php echo $data['subtitle'];?>" required >
								</div>
							</div>

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_Status'];?> </label>
									<select name="status" class="form-control" required>
									<option value=""><?php echo $lang['Select_Status'];?></option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>><?php echo $lang['Publish'];?></option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>><?php echo $lang['UnPublish'];?></option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Min_Order_Amount'];?></label>
									<input type="text" id="cname"  class="form-control numberonly" value="<?php echo $data['min_amt'];?>" name="min_amt" required >
								</div>
								</div>
								
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_Value'];?></label>
									<input type="text" id="cname" class="form-control numberonly" value="<?php echo $data['coupon_val'];?>"  name="coupon_val" required >
								</div>
							</div>

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_Description'];?></label>
									<textarea class="form-control" rows="5" name="description"  style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary"><?php echo $lang['Edit_Coupon'];?></button>
                                    </div>
                                </form>
					 <?php 
					 }
				 else 
				 {
				 ?>
                  <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Image'];?></label>
									<input type="hidden" name="type" value="add_coupon"/>
									<input type="file" name="coupon_img" class="form-control"  required>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Expiry_Date'];?></label>
									<input type="date" name="expire_date" class="form-control"  required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
								
									<label for="cname"><?php echo $lang['Coupon_Code'];?> </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="coupon_code" required  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_title'];?> </label>
									<input type="text"  class="form-control"  name="title" required >
								</div>
							</div>
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_subtitle'];?> </label>
									<input type="text"  class="form-control"  name="subtitle" required >
								</div>
							</div>

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_subtitle'];?> </label>
									<select name="status" class="form-control" required>
									<option value=""><?php echo $lang['Select_Status'];?></option>
									<option value="1"><?php echo $lang['Publish'];?></option>
									<option value="0"><?php echo $lang['UnPublish'];?></option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label><?php echo $lang['Coupon_Min_Order_Amount'];?></label>
									<input type="text" id="cname"  class="form-control numberonly"  name="min_amt" required >
								</div>
								</div>
								
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_Value'];?></label>
									<input type="text" id="cname" class="form-control numberonly"  name="coupon_val" required >
								</div>
							</div>

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname"><?php echo $lang['Coupon_Description'];?> </label>
									<textarea class="form-control" rows="5" name="description"  style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary"><?php echo $lang['Add_Coupon'];?></button>
                                    </div>
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