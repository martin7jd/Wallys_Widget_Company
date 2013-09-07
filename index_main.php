<?php
  /*
    File_name:    index_main.php

    Description:  Landing page for this website
    
    Authors:      Martin Rose

    Revision:     0.0
    Comments:     None
  */  
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Wally's Widget Company</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="jscript/widget.js" type="text/javascript"></script>    
    <link rel="stylesheet" href="css/widget.css" />
        
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
  </head>
  <body>
	<table width="100%">
		<tr>
			<td style="background-color:lightgrey">
				<IMG class="displayed" src="./images/Stamp_Wally.png" alt="Where's Wally" >
			</td>
		</tr>
	</table>			  
    <div id="tabs">
      <ul>
        <li>
          <a href="#tabs-1" id="widgets" onclick="page(this.id)">Widgets</a>
        </li>
        <li>
          <a href="#tabs-2" id="stock_control" onclick="page(this.id)">Stock Control</a>
        </li>
      </ul>
      <div id="tabs-1">
        <div class="menu_div" id="left-box">
        <div id="top_padding">
        </div>                
        	<ul>
            	<li>
              		<a href="#" id="calculate_packs" onclick="page(this.id)">Calculate Pack Quantities<div id="i"></div></a><!--index_pack_calculate.php-->              
            	</li>
          	</ul>                
        </div>
        <div id="content_1"> 

          <h3>Wally's Widget Stock Control</h3>                                  
          You can calculate the number of packs required to make-up the customers order. Click "Calculate Pack Quantities" to get started<br/><br/>
<?php 

  	#	For database connection
  		require_once('./common/con_localhost.php'); 
  		
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
        
        </div>                                 
      </div>
      <div id="tabs-2">
        <div class="menu_div" id="left-box">
    	<div id="top_padding">
        </div>                
          <ul>
            <li>
              <a href="#" id="pack_size_control" onclick="page(this.id)">Pack Sizes<div id="i"></div></a><!--index_pack_control.php-->              
            </li>
          </ul>        
        </div>
        <div id="content_2">
        </div>
     </div>
      <div id="tabs-3">
      </div>
      <div id="tabs-4">
      </div>
      <div id="tabs-5">
      </div>            
    </div>    

	<!-- Debug page information-->  
  	<div id="debug_info">Debug Info: index_main.php</div>
  
  </body>
</html>