<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
    	
    	table{
			width:100%;
		}
		
		td{
			vertical-align:bottom;
		}
		
		#topBar{		
			background:#D3D3D3;	
			text-align:center;
			font-family:"Arial black", Times, serif;
			font-size:40px				
		}
		
		#widgetList{		
			padding-left:10px;		
		}
		
		#print{
			background-color:#77d42a;
			color:#ffffff;
			position:absolute;
			left:50px;
			top:150px;		
		}
		
		#totalWidgets{
  			padding-left:5px;
  			padding-top:5px;      
  			padding-bottom:5px;      		
		}
		
		#debug_info{
    		position:absolute;
    		bottom:0;
    		right:0;
    		color:#FFFFFF;
			background:#d40203;
  			padding-left:5px;
  			padding-top:5px;      
  			padding-bottom:5px;      
  			padding-right:5px;      
		}		
  </style>

</head>
<body>

<?php
	
#	Quantity of widgets ordered 
	$quantity = $_GET['required'];

#	Json encode pass through URL	
	$keyValue = $_GET['result'];

#	Json decode to get array of key value pairs for packet size and quantity
	$test = json_decode($keyValue);

?>

	<table border="1">

		<tr>
			<td colspan="2" id="topBar">
				<div>Wally's Widget Company</div>
				<div>Pick List</div>
			&nbsp;
			</td>
		</tr>
		<tr>
			<th>Pack Size</th><th>Quantity</th>
		</tr>
		
<?php

	foreach($test as $key=>$value){
	
		echo '<tr><td id="widgetList">' . $key . '</td><td id="widgetList">' . $value . '</td></tr>'; 
	
	} 

		$user = $_ENV["LOGNAME"];

		echo '<tr>';

			echo '<td id="totalWidgets" colspan="2">Printed By: ' . $user . '</td>';
		
		echo '</tr>';
		echo '<tr>';

			echo '<td id="totalWidgets" colspan="2">Pick Date: ' . date('D, d M Y H:i:s') . '</td>';
		
		echo '</tr>';

		echo '<tr>';

			echo '<td id="totalWidgets" colspan="2">Total Number of Widgets Ordered: ' . $quantity . '</td>';
		
		echo '</tr>';
	
?>
	
	</table>			  

 	<button id="print" onclick="window.print(); return false;">Print</button> 
 	
 	
	<div id="debug_info">Debug Info: php/index_pack_print.php</div> 	
</body>
</html>