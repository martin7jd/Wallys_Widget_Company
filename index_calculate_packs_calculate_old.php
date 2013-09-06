<?php

  	#	For database connection
  		require_once('./common/con_localhost.php'); 
  		
	#	Link to database				
		$link = local_db_connect();  		 

	#	Passed Post
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
		
		
		//print_r($reversed);
		
		$arraysize = sizeof($reversed);
		
		//echo '<br/>' . $arraysize . '<br/>';


		
		
		for ($i = 0; $i <= ($arraysize - 1); $i++) {
		
				//echo '<br/><br/>' . $i . '  Here is IIII<br/>';
    		    		
    		//echo $qty_required  . ' / ' .$reversed[$i] . '<br/>';
    		
    		//echo ($qty_required / $reversed[$i]) . ' here<br/>';

		#	Find if the result is a whole number and not zero
			$result = (int) ($qty_required / $reversed[$i]);
			
		#	If the result is a whole number, times the whole number by current pack size and subtract it from the total
			
			//echo $result . ' This is the result<br/>';
			
			$z = 0;
			
			if($result > 0){
			
				//echo '<br/>' . $qty_required . ' QTY Required<br/>';
							
				
				$remainder = ($qty_required - ($result * $reversed[$i]));
			
				
				$resultArray[$reversed[$i]] = $result;
			
			
				//if($arraysize == $reversed[$i]){
				
					//echo 'Here is the end';
				
				//}
				$z++;
			
			}
			
			//echo $remainder . ' Remainder <br/>';
			//echo $result . '  Result<br/>';
			if($z > 0){
				$qty_required = $remainder;			
			
			}
			
			unset($z);
			
			//echo $qty_required . ' Bottom remainder qty<br/>';
			
			//echo $reversed[$i] . ' This is the set packet sizes<br/>';
		
			$allThatIsLeft = $qty_required;
			$t = $arraysize - 2;
			$secondToLastPack = $reversed[$t];
			
			$lastPack = $reversed[$i];
		
		}
			echo $allThatIsLeft . ' All That is left<br/>';
			//echo $secondToLastPack . ' Second to last pack<br/>';
			//echo $lastPack . ' Last Pack<br/>';
			
			if($allThatIsLeft > 0){
			
		#	See if the pack key is already in the array
			$search_array = $resultArray;
				
				if (array_key_exists($lastPack, $search_array)) {
    				echo 'It is there<br/>';
				
					#	Get the value of the key
						$keyValue = $resultArray[$lastPack];
				
						echo $keyValue . ' Here NEEDS SORTING ';
					
					#	Remove the lowest one in the array and add the second to last + 1	
						//unset($resultArray[$lastPack]);
						//$resultArray[$secondToLastPack]	=	1;				

						
						
						
				
				}	else	{
				
					#	Add the key=>value pair to the array							
						$resultArray[$lastPack]	=	1;				
				
				}			
			}
		
				
				
				
			
			echo '<br/><br/><br/>';
			print_r($resultArray);
		
		
		
		
		}	else	{
		
			echo '<h3>Warning</h3>';
		
			echo 'Type in a number please!';
		
		}

	#	Close database connaction
    	mysqli_close($link);

?>



<br/><br/>Debug Information: index_calculate_packs_calculate.php