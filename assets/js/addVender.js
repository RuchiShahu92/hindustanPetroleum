/**
 * File : addVender.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addVender");
	
	var validator = addUserForm.validate({
		
		rules:{
			name :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			address : { required : true },
			pincode : {required : true, digits : true },
			phone_no : { required : true, digits : true } 
		},
		messages:{
			name :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			address : { required : "This field is required" },
			pincode : {required : "This field is required", digits : "Please enter numbers only" },
			phone_no : { required : "This field is required", digits : "Please enter numbers only" } 		
		}
	});
});
