<?php 
require "api/Prozigzig.php";
$h = new Prozigzig($probus);
$query = "SELECT * FROM `tbl_setting`";
		  $set = $h->fetchData($query);
		 
date_default_timezone_set($set['timezone']);

if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
	
		$query = "SELECT * FROM `tbl_bus_operator` where email='".$_SESSION['busname']."'";
		  $sdata = $h->fetchData($query);
		}
	}
if($_SESSION['stype'] == 'sowner')
		{
echo $sdata['dark_mode'];
		}
		else 
		{
			echo $set['show_dark'];
		}

?>