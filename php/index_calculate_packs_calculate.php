<?php

  	#	For database connection
  		require_once('../common/con_localhost.php'); 
  		
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
		
		$qty_require = $result_1;	
		
		for ($i = 0; $i <= ($arraysize - 1); $i++) {
		
	#	Find if the result is a whole number and not zero
		$result = (int) ($qty_require / $reversed[$i]);
			
	#	If the result is a whole number, times the whole number by current pack size and subtract it from the total			
		$z = 0;
			
			if($result > 0){
							
				$remainder = ($qty_require - ($result * $reversed[$i]));
			
				
				$resultArray[$reversed[$i]] = $result;
				
				$z++;
			
			}
			
			if($z > 0){
				$qty_require = $remainder;						
			}
			
			unset($z);
					
			$allThatIsLeft = $qty_required;
			$t = $arraysize - 2;
			$secondToLastPack = $reversed[$t];
			
			$lastPack = $reversed[$i];
		
		}
						
			echo '<br/><br/><br/>';
			
			echo '<table class="resultsTable">';
			
				echo '<th colspan="2">Order Fulfilment</th>';
				
					echo '<tr>';
						
						echo '<th>Package Size</th><th>Qty</th>';
					
					echo '</tr>';
					if (!empty($packQtyList)){
						
						#	Variable initialised ready for altertantive row colours
							$c = true;
								
							foreach ($resultArray as $key_1 => $value_1) {
								echo '<tr'.(($c = !$c)?' class="odd"':' class="even"').">";

    								echo'<td>' . $key_1 . '</td><td>' . $value_1 . '</td>';
				
								echo '</tr>';		
							
								#	Total the number of packs and asign it to a variable
									
								$totalWidgets = $totalWidgets + $value_1;
							}
							
							echo '<tr id="total">';
								echo '<td >Total Packs:</td><td>' . $totalWidgets . '</td>';
							echo '</tr>';
							echo '<tr>';
					
							#	Convert Associated Array to a string						
								$changeToString = json_encode($resultArray);
					
									echo '<td><button onclick="printPrep(\'' . $qty_required . '\', \'' . urlencode($changeToString) . '\')">Print pick list</button></td>';
							echo '</tr>';
															
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
	<div id="debug_info">Debug Info: php/index_calculate_packs_calculate.php</div>