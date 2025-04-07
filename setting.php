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
                  <h3><?php echo $lang['Setting_Management'];?></h3>
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
				
						
						<h5 class="h5_set"><i class="fa fa-gear fa-spin"></i>  <?php echo $lang['General_Information'];?></h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group mb-3 col-2">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Website_Name'];?></label>
                                            <input type="text" class="form-control " placeholder="<?php echo $lang['Enter_Website_Name'];?>" value="<?php echo $set['webname'];?>" name="webname" required="">
											<input type="hidden" name="type" value="edit_setting"/>
										<input type="hidden" name="id" value="1"/>
                                        </div>
										
                                      <div class="form-group mb-3 col-3" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Website_Image'];?></label>
                                            <div class="custom-file">
                                                <input type="file" name="weblogo" class="custom-file-input form-control">
                                                <label class="custom-file-label"><?php echo $lang['Choose_Website_Image'];?></label>
												<br>
												<img src="<?php echo $set['weblogo'];?>" width="60" height="60"/>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-3">
									<label for="cname"><?php echo $lang['Select_Timezone'];?></label>
									<select name="timezone" class="form-control" required>
									<option value=""><?php echo $lang['Select_Timezone'];?></option>
									<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $set['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
										
										<div class="form-group mb-3 col-2">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Currency'];?></label>
                                            <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Currency'];?>"  value="<?php echo $set['currency'];?>" name="currency" required="">
                                        </div>
										
										<div class="form-group mb-3 col-2">
                                            <label><span class="text-danger">*</span><?php echo $lang['Agent_Withdraw_Limit'];?></label>
                                            <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Withdraw_Limit'];?>"  value="<?php echo $set['agent_limit'];?>" name="agent_limit" required="">
                                        </div>
										
										<div class="form-group mb-3 col-2">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Operator_Withdraw_Limit'];?></label>
                                            <input type="text" class="form-control" placeholder="<?php echo $lang['Enter_Withdraw_Limit'];?>"  value="<?php echo $set['operator_limit'];?>" name="agent_limit" required="">
                                        </div>
										
										
										
										
										
										
										
										
	
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-signal"></i> <?php echo $lang['Onesignal_Information'];?></h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> <?php echo $lang['User_App_Onesignal_App_Id'];?></label>
                                            <input type="text" class="form-control " placeholder="<?php echo $lang['Enter_User_App_Onesignal_App_Id'];?>"  value="<?php echo $set['one_key'];?>" name="one_key" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> <?php echo $lang['User_App_Onesignal_Rest_Api_Key'];?></label>
                                            <input type="text" class="form-control " placeholder="<?php echo $lang['Enter_User_Boy_App_Onesignal_Rest_Api_Key'];?>"  value="<?php echo $set['one_hash'];?>" name="one_hash" required="">
                                        </div>
	
										
										
										
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $lang['Refer_And_Earn_Information'];?></h5>
										</div>
										
										<div class="form-group mb-3 col-3">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Sign_Up_Credit'];?></label>
                                            <input type="text" class="form-control numberonly" placeholder="<?php echo $lang['Enter_Sign_Up_Credit'];?>"  value="<?php echo $set['scredit'];?>" name="scredit" required="">
                                        </div>
										
										<div class="form-group mb-3 col-3">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Refer_Credit'];?></label>
                                            <input type="text" class="form-control numberonly" placeholder="<?php echo $lang['Enter_Refer_Credit'];?>"  value="<?php echo $set['rcredit'];?>" name="rcredit" required="">
                                        </div> 
										
										<div class="form-group mb-3 col-3">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Tax'];?>(%)</label>
                                            <input type="number" step="0.01" min="1" max="100" class="form-control numberonly" placeholder="<?php echo $lang['Enter_Tax'];?>"  value="<?php echo $set['tax'];?>" name="tax" required="">
                                        </div> 
										
										<div class="form-group mb-3 col-3">
                                            <label><span class="text-danger">*</span> <?php echo $lang['Agent_Status'];?></label>
                                           <select class="form-control" name="agent_status">
										   <option value="1" <?php if($set['agent_status'] == 1){echo 'selected';}?>><?php echo $lang['Yes'];?></option>
										   <option value="0" <?php if($set['agent_status'] == 0){echo 'selected';}?>><?php echo $lang['No'];?></option>
										   </select>
                                        </div> 
										
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Sms Type</label>
                                           <select class="form-control" name="sms_type">
										   <option value="">select sms type</option>
										   <option value="Msg91" <?php if($set['sms_type'] == 'Msg91'){echo 'selected';}?>>Msg91</option>
										   <option value="Twilio" <?php if($set['sms_type'] == 'Twilio'){echo 'selected';}?>>Twilio</option>
										  
										   </select>
                                        </div>
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fas fa-sms"></i> Msg91 Sms Configurations</h5>
										</div>
	                                    
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Msg91 Auth Key</label>
                                            <input type="text" class="form-control " placeholder="Msg91 Auth Key"  value="<?php echo $set['auth_key'];?>" name="auth_key" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> Msg91 Otp Template Id</label>
                                            <input type="text" class="form-control " placeholder="Msg91 Otp Template Id"  value="<?php echo $set['otp_id'];?>" name="otp_id" required="">
                                        </div>
										
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fas fa-sms"></i> Twilio Sms Configurations </h5>
										</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span>Twilio Account SID</label>
                                            <input type="text" class="form-control " placeholder="Twilio Account SID"  value="<?php echo $set['acc_id'];?>" name="acc_id" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Twilio Auth Token</label>
                                            <input type="text" class="form-control " placeholder="Twilio Auth Token"  value="<?php echo $set['auth_token'];?>" name="auth_token" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Twilio Phone Number</label>
                                            <input type="text" class="form-control " placeholder="Twilio Phone Number"  value="<?php echo $set['twilio_number'];?>" name="twilio_number" required="">
                                        </div>
										
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-phone"></i> Otp Configurations</h5>
										</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Otp Auth In Sign up ? </label>
                                            <select class="form-control" name="otp_auth">
										   <option value="">Select Option</option>
										   <option value="Yes" <?php if($set['otp_auth'] == 'Yes'){echo 'selected';}?>>Yes</option>
										   <option value="No" <?php if($set['otp_auth'] == 'No'){echo 'selected';}?>>No</option>
										   
										   </select>
                                        </div>
										
										
										
										
										
								
								
								
										<div class="col-12">
                                                <button type="submit" name="edit_setting" class="btn btn-primary mb-2"><?php echo $lang['Edit_Setting'];?></button>
                                            </div>
											</div>
                                    </form> 
	
								
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