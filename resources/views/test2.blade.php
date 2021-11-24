<?php
	$interval = date_diff(date_create(), date_create($dateOfBirth));
	echo $interval->format("%yy, %mm, %dd");
?>