	<h3>Pack Deleted</h3>

<?php
  
  	#	For database connection
  		require_once('../common/con_localhost.php');  

		$link = local_db_connect();
    
		$numToDelete = $_POST['pack_size'];

    #	Delete the entry in the database
        mysqli_query($link, 'DELETE FROM widget_packs WHERE widget_pack_size = "' . $numToDelete . '"');         
    	    	
    	mysqli_close($link);

?>

	<!-- Debug page information-->
	<div id="debug_info">Debug info: php/index_pack_size_control_delete.php</div>