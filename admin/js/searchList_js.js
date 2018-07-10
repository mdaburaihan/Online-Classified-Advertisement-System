   $(document).ready(function(){ 
   	$("select#srch").change(function(){
   		var selectedItem = $("#srch option:selected").val();
      //alert(selectedItem);
   		// if(selectedItem == "Category")
   		// {
   			$('#searchAds').keyup(function(){
   				var searchAds=$(this).val();
   				if(searchAds !='')
   				{
   					$.ajax({
   						url:"searchList.php",
   						method:"POST",
   						data:{searchAds:searchAds,selectedItem:selectedItem},
   						datatype:"text",
   						success:function(data){
   							$('#searchstatus').fadeIn();
   							$('#searchstatus').html(data);
   						}
   					});

   				}


   			});
   			$(document).on('click','li',function(){
   				$('#searchAds').val($(this).text());
   				$('#searchstatus').fadeOut();

   			});
   		//}

   		// if(selectedItem == "Subcategory")
   		// {
   		// 	$('#searchAds').keyup(function(){
   		// 		var searchAds=$(this).val();
   		// 		if(searchAds !='')
   		// 		{
   		// 			$.ajax({
   		// 				url:"searchList.php",
   		// 				method:"POST",
   		// 				data:{searchAds:searchAds,selectedItem:selectedItem},
   		// 				datatype:"text",
   		// 				success:function(data){
   		// 					$('#searchstatus').fadeIn();
   		// 					$('#searchstatus').html(data);
   		// 				}
   		// 			});

   		// 		}


   		// 	});
   		// 	$(document).on('click','li',function(){
   		// 		$('#searchAds').val($(this).text());
   		// 		$('#searchstatus').fadeOut();

   		// 	});
   		// }

   		// if(selectedItem == "City")
   		// {
   		// 	$('#searchAds').keyup(function(){
   		// 		var searchAds=$(this).val();
   		// 		if(searchAds !='')
   		// 		{
   		// 			$.ajax({
   		// 				url:"searchList.php",
   		// 				method:"POST",
   		// 				data:{searchAds:searchAds,selectedItem:selectedItem},
   		// 				datatype:"text",
   		// 				success:function(data){
   		// 					$('#searchstatus').fadeIn();
   		// 					$('#searchstatus').html(data);
   		// 				}
   		// 			});

   		// 		}


   		// 	});
   		// 	$(document).on('click','li',function(){
   		// 		$('#searchAds').val($(this).text());
   		// 		$('#searchstatus').fadeOut();

   		// 	});
   		// }
   	});
   });