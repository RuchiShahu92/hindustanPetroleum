/**
 * @author ruchi shahu
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
		 
			hitURL = baseURL + 'deleteUser',
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
	 
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".deleteData", function(){
		var Id = $(this).data("userid");
		var url = $(this).data("url");
			hitURL = baseURL + url;
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this data ?");
	 
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : Id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
