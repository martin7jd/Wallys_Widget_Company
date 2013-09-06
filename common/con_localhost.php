<?php
	
	/*	Database connection file. Currently set to user: root password: root	*/
	
	function local_db_connect(){
		
	#	Set database username and password here
		$link = mysqli_connect('localhost', 'root','root');
			if (!$link) {
				die('Could not connect: ' . mysqli_error());
		}
		$db_selected = mysqli_select_db($link, 'widgets');
			if (!$db_selected) {
				die ('Cannot use foo : ' . mysqli_error());
		}
			return ($link);
		}

?>