        <h3>Wally's Widget Stock Control</h3>                                  
        You can calculate the number of packs required to make-up the customers order. Click "Calculate Pack Quantities" to get started<br/><br/>

		<div id="debug_info">Debug Info: php/index_widgets_splash.php</div>

<?php 

  	#	For database connection
  		require_once('../common/con_localhost.php'); 
  		
	#	Link to database				
		$link = local_db_connect();  		 
		
	#	Read in the Pack quantities
    	$getValues = 'SELECT * FROM widget_packs';
            
    	$getValue = mysqli_query($link,$getValues) or die(mysqli_error());    
    	
    		while($value = mysqli_fetch_array($getValue)){
    		    	
    			$packQtyList[] = $value['widget_pack_size'];
    	
    		} 
    		
	#	Incase more packs are added
		sort($packQtyList);
    		
    		echo '<h3>Current Stock Quantities</h3>'; 
    		echo '<p>Packs come in the current sizes:</p>';            
		
			foreach($packQtyList as $list){

				echo '<div id="stockList">';
		
					echo $list . '<br/>';
				
				echo '</div>';		
			}
			
		
	#	Close database connaction
    	mysqli_close($link);


?>
