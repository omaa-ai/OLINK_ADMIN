<?php 
require 'api/Prozigzig.php';
$h = new Prozigzig($probus);
$busid = $_POST['busid'];

$query = "select * from tbl_bus where id=".$busid;
		  $busdata = $h->queryfire($query)->fetch_assoc();
		  
$facility = $h->queryfire("select * from tbl_facility where id IN(".$busdata['bus_facility'].")");
?>
<div class="row">
<?php 
while($row = $facility->fetch_assoc())
{
	?>
	<div class="col-3 text-center">
    <img src="<?php echo $row['img'];?>" width="50px">
    <p><?php echo $row['title'];?></p>
</div>
	<?php 
}
?>
</div>