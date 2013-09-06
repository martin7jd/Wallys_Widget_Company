<?php

  	#	For database connection
  		require_once('./common/con_localhost.php'); 
  		
	#	Link to database				
		$link = local_db_connect();  		 

	#	Quantity passed Post
		$qty_required = $_POST['qty_required'];
	
	#	Check it's a number first
		$pattern = '/^\d+$/';
		preg_match($pattern, substr($qty_required,0), $matches, PREG_OFFSET_CAPTURE);
		
	#	Size of the array
		if(!empty($matches)){	
	
	#	Read in the Pack quantities
    	$getValues = 'SELECT * FROM widget_packs';
            
    	$getValue = mysqli_query($link,$getValues) or die(mysqli_error());    
    	
    	while($value = mysqli_fetch_array($getValue)){
    	
    		$packQtyList[] = $value['widget_pack_size'];
    	
    	}              

	#	Incase more packs are added
		sort($packQtyList);
		
	#	Reverse array order so highest first
		$reversed = array_reverse($packQtyList);		
				
		$arraysize = sizeof($reversed);
		
	#	Divide the quantity required by the lowest number of packets				
		$test = $qty_required/$reversed[$arraysize - 1];
		
		$test_1 = ceil($test);
					
		$result_1 = $test_1 * $reversed[$arraysize - 1];
		
		$qty_required = $result_1;	
		
		for ($i = 0; $i <= ($arraysize - 1); $i++) {
		
	#	Find if the result is a whole number and not zero
		$result = (int) ($qty_required / $reversed[$i]);
			
	#	If the result is a whole number, times the whole number by current pack size and subtract it from the total			
		$z = 0;
			
			if($result > 0){
							
				$remainder = ($qty_required - ($result * $reversed[$i]));
			
				
				$resultArray[$reversed[$i]] = $result;
				
				$z++;
			
			}
			
			if($z > 0){
				$qty_required = $remainder;			
			
			}
			
			unset($z);
					
			$allThatIsLeft = $qty_required;
			$t = $arraysize - 2;
			$secondToLastPack = $reversed[$t];
			
			$lastPack = $reversed[$i];
		
		}
						
			echo '<br/><br/><br/>';
			
			echo '<table border="0">';
			
				echo '<th colspan="2">Order Fulfilment</th>';
				
					echo '<tr>';
						
						echo '<th>Pakage Size</th><th>Qty</th>';
					
					echo '</tr>';
					if (!empty($packQtyList)) {

								
							foreach ($resultArray as $key_1 => $value_1) {
								echo '<tr>';

    								echo'<td class="center">' . $key_1 . '</td><td class="center">' . $value_1 . '</td>';
				
								echo '</tr>';		
							}			
					}	else	{
					
    					echo'<td colspan="2" class="center_error">Widget Packs need to be added through the Stock Control tab</td>';					
					
					}
			echo '</table>';
		
		
		}	else	{
		
			echo '<h3>Warning</h3>';
		
			echo 'Type in a number please!';
		
		}

	#	Close database connaction
    	mysqli_close($link);

?>

	<!-- Debug page information-->
	<div id="debug_info">Debug Info: index_calculate_packs_calculate.php</div>