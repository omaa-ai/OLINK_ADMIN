<?php 
require 'api/Prozigzig.php';
$h = new Prozigzig($probus);
$busid = $_POST['busid'];


		  
$review = $h->queryfire("select * from  tbl_book where bus_id=".$busid." and is_rate=1");
$count = $review->num_rows;

?>
<div class="row">
    <?php if($count != 0) { ?>
        <?php while($row = $review->fetch_assoc()) {
$query = "SELECT * FROM `tbl_user` where id=".$row['uid'];
		  $userdata = $h->queryfire($query)->fetch_assoc();
			?>
            <div class="col-12 review-item">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="user-info">
                            <img src="images/profile.png" width="50px" class="profile-img">
                            <p><?php echo $userdata['name'];?></p>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <div class="rating-section">
                            <?php if($row['total_rate'] > 0) { ?>
                                <div class="star-rating">
                                    <?php for($i = 0; $i < $row['total_rate']; $i++) { ?>
                                        <img src="images/star.png" width="20px">
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="no-rating">No rating</div>
                            <?php } ?>
                        </div>
                        <div class="comment-section">
                            <p><?php echo $row['rate_text'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="col-12">
            No Review Found!!
        </div>
    <?php } ?>
</div>