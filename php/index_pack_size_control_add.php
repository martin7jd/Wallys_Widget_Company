<?php

  	#	For database connection
  		require_once('../common/con_localhost.php');  

	#	Link to database				
		$link = local_db_connect();

	#	Passed number
		$pack_qty = $_POST['pack_qty'];

	#	Check if it's a number
		$pattern = '/^\d+$/';
		preg_match($pattern, substr($pack_qty,0), $matches, PREG_OFFSET_CAPTURE);
		
	#	Size of the array
		if(!empty($matches)){

	#	Check the database to see if the number is already there
    	$getValues = 'SELECT * FROM widget_packs';
            
    	$getValue = mysqli_query($link,$getValues) or die(mysqli_error());    
        
    	while($value = mysqli_fetch_array($getValue)){
    	
     		$fullList[] = $value['widget_pack_size'];            
   	    	
    	}   
	
	#	Check if it's in the array
		if (!in_array($pack_qty, $fullList)) {
    		$insertNumber = 'INSERT INTO widgets.widget_packs(widget_pack_size)VALUES("' . $pack_qty . '")';	
        
        	$commit_insertNumber = mysqli_query($link,$insertNumber);
        
        	if(!$commit_insertNumber){            
            die('Invalid query' . __LINE__ . ' index_pack_size_control_add.php : ' . mysqli_error());
        	}
        		
			echo '<h3>Congratulations</h3>';
			echo 'A pack size of ' . $pack_qty . ' widgets has been added';
		
		
		}else{
		
			echo '<h3>Warning</h3>';
		
    		echo "This pack size is already in the database";		
		
		}

		
		}else{
		
		echo '<h3>Warning</h3>';
		
		/*	They need to type in a number */
			echo 'Please try again and enter a number';
		
		}

	#	Close database connaction
    	mysqli_close($link);


?>

	<!-- Debug page information-->
	<div id="debug_info">Debug info: php/index_pack_size_control_add.php</div>