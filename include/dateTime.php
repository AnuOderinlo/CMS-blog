<?php 	
    date_default_timezone_set("Africa/Lagos");
	 $today = date("d:M:Y h:i:sa", time());
	 echo $today;
	// print_r(getdate(time()));
/*$terminationDate = new DateTime('today');
$todaysDate = new DateTime('2020-07-5');
$span = $terminationDate->diff($todaysDate);
echo "Your subscription ends in {$span->format('%m')} month and {$span->format('%d')} days!";*/


 ?>