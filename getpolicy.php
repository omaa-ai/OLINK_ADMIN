<?php 
require 'api/Prozigzig.php';
$h = new Prozigzig($probus);
$busid = $_POST['busid'];

$query = "select * from tbl_page where id=4";
		  $pagedata = $h->queryfire($query)->fetch_assoc();
		  

?>
<div class="row">
	<div class="col-12 text-center">
    <h5><?php echo $pagedata['title'];?></h5>
    <p><?php echo $pagedata['description'];?></p>
</div>
</div>