/* perform JavaScript after the document is scriptable. */
   $(function() {
  /* setup ul.tabs to work as tabs for each div directly under div.panes  */
    $("ul.tabs").tabs("div.panes > div");
  });


  function page(selId){

  	$(document).ready(function(){


		if(selId == 'widgets'){	
			$.get('php/index_widgets_splash.php', {}, function(result, status){				
				if(status == 'success'){
					$("#content_1").html(result);
				}
			});
						
		}	else if(selId == 'stock_control'){
				$.get('php/index_calculate_splash.php', {}, function(result, status){				
					if(status == 'success'){
						$("#content_2").html(result);
				}
			});

        }	else if(selId == 'calculate_packs'){
				$.get('php/index_calculate_packs.php', {}, function(result, status){				
						if(status == 'success'){
								$("#content_1").html(result);
						}
				});
    		

        }	else if(selId == 'pack_size_control')	{
				$.get('php/index_pack_size_control.php', {}, function(result, status){				
						if(status == 'success'){
							$("#content_2").html(result);
						}
				});

        }	else if(selId == 'debug_control')	{
				$.get('php/index_debug_control.php', {}, function(result, status){				
						if(status == 'success'){
							$("#content_3").html(result);
						}
				});
		}	
	});
}


  	function make_calculation(){
  	
		var qty_required = document.getElementById("qty_required").value;
  	
		$(document).ready(function(){
		
			if(qty_required == ''){
		
				alert("Please type in A Number");
		
			}	else	{
		
				$.post('php/index_calculate_packs_calculate.php', {qty_required:qty_required}, function(result, status){				
					if(status == 'success'){
						$("#calc_result").html(result);
					}
				});			
			}
		});
	
	}


	function add_quantity(){
		var pack_qty = document.getElementById("pack_qty").value;
  	
		$(document).ready(function(){
		
			if(pack_qty == ''){
		
				alert("Please type in a number");
		
			}	else	{
		
				$.post('php/index_pack_size_control_add.php', {pack_qty:pack_qty}, function(result, status){				
					if(status == 'success'){				
				
						$.get('php/index_pack_size_control.php', {}, function(result, status){				
							if(status == 'success'){
								$("#content_2").html(result);
							}
						});					
					}
				});			
			}
		});
	}

	function delete_number(pack_size){
	
		$(document).ready(function(){
	
			$.post('php/index_pack_size_control_delete.php', {pack_size:pack_size}, function(result, status){				
				if(status == 'success'){
				
					$.get('php/index_pack_size_control.php', {}, function(result, status){				
							if(status == 'success'){
								$("#content_2").html(result);
							}
					});
				}
			});					
		});
	}

	function setDebug(status){
		
		$(document).ready(function(){
	
			$.post('php/index_debug_control_toggle.php', {status:status}, function(result, status){				
				if(status == 'success'){
					$("#content_3").html(result);
				}
			});					
		});
	}

	function printPrep(required, result){
	
			var line = "php/index_pack_print.php?required=" + required + "&result=" + result;
			newWin = open(line, "Print", "width=796", "height=1123", "copyhistory=yes", "resizable=no", "scrollbars=yes", "location=no");			
			
			$(document).ready(function(){
				
				$.get('php/index_calculate_packs.php', {}, function(result, status){				
						if(status == 'success'){
								$("#content_1").html(result);
						}
				});
			});
	}
		
	
/*  Resets a div in a page	*/
    function resetCalField(){
      $("#qty_required").html("");      
    }
    