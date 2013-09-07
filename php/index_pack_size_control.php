	<h3>Pack Quantities</h3>

<?php
  
  	#	For database connection
  		require_once('../common/con_localhost.php');  

		$link = local_db_connect();

	#	Get host info so that it can be writen to the install.php page that is created below
    	$getValues = 'SELECT widget_pack_size FROM widget_packs';
    	            
    	$getValue = mysqli_query($link, $getValues) or die(mysqli_error());            
    	 		
		echo '<table border="0">';
			echo '<th colspan="3">Packs</th>';
		
      while($numbers = mysqli_fetch_array($getValue)){
    
      
      		$packSize[] = $numbers['widget_pack_size'];
      
      }
      
		sort($packSize);
      
      foreach($packSize as $listNumeber){
 			 	echo '<tr>';	
					echo '<td>' . $listNumeber . ' </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><button id="pack_size" onclick="delete_number(\'' . $listNumeber . '\')">Delete now?</button></td>';
				echo '</tr>';					
      
      }

		echo '</table>';
	
	#	Add a pack size to database
?>	

<br/>	
    <form>
     <table>   
        <tr>
        	<td><input type="text" id="pack_qty" placeholder="Type in a quantity..."/></td>
        	<td><input type="submit" class="submit" value='Add Now!' autocomplete="off" onclick="add_quantity()" /></td>
        </tr>

    </table>
    </form>
		
	<!-- Debug page information-->
    <div id="debug_info">Debug Info: php/index_pack_size_control.php</div>
    
<?php
    
    mysqli_close($link);

?>