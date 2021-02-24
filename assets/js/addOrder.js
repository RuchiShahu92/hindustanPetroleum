/**
 * File : addCompanyDetail.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addOrderDetail");
	
	 var validator = addUserForm.validate({
		//ignore: [],
	    ignore: ":hidden",  
		rules:{
			company_id :{ required : true },
			vender_id : { required : true },
			"product_name[]" : { required : true }, 
			"product_price[]" : { required : true, digits : true },
			"product_qty[] ": {required : true, digits : true },
		},
		messages:{
			company_id : { required : "This field is required" },
			vender_id : { required : "This field is required"  },
			"product_name[]" : { required : "This field is required" },
			"product_price[]" : { required : "This field is required", digits : "Please enter numbers only" } ,
			"product_qty[]"  : {required : "This field is required", digits : "Please enter numbers only" },
					
		}
	}); 
	
	$("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

	
 
});
function add_more_product(){
	 
	var  inlinehtml =  '';
		inlinehtml += '<div class="col-md-12"  >';
		inlinehtml += '<div class="row control-group" >';
		inlinehtml += '<div class="col-md-12 " >';
		inlinehtml += '<div class="col-md-4">';
		inlinehtml += '<div class="form-group">';
		inlinehtml += '<label for="product_name">Product Name  </label>';
		inlinehtml += '<input type="text" class="form-control required"   name="product_name[]" >';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
		inlinehtml += '<div class="col-md-3">';
		inlinehtml += '<div class="form-group">';
		inlinehtml += '<label for="product_qty">Qty </label>';
		inlinehtml += '<input type="text" class="form-control required classQty" name="product_qty[]" >';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
		inlinehtml += '<div class="col-md-4">';
		inlinehtml += '<div class="form-group">';
		inlinehtml += '<label for="product_price">Price </label>';
		inlinehtml += '<input type="text" class="form-control required classPrice" name="product_price[]" >';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
		inlinehtml += '<div class="col-md-1">';         
		inlinehtml += '<div class="form-group">';
		inlinehtml += '<label for=" "> &nbsp; &nbsp; &nbsp;   </label>';
		inlinehtml += '<button type="button" class="btn btn-sm btn-info remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>';
		inlinehtml += '</div> ';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
		inlinehtml += '</div>';
			 
        $(".after-add-more").append(inlinehtml);
       // sumOfColumns();

}

 

 function calculateSum(){

    var totalPrice = 0; 
    $(".classPrice").each(function(){
    	//alert(this.value);
        totalPrice += (parseInt(this.value)).toFixed(2);
        
    });
    $("#gross_total_td").html(totalPrice);
    subtotal();
}

$('input[type=radio][name=gst_type]').change(function() {
	
	if (parseInt(this.value) == 1) {
		$('#gst_div').hide(); 
		$('#igst_div').show();
	}
	else{
		$('#igst_div').hide(); 
		$('#gst_div').show();
	}

});

$(document).on("click ready keyup change", ".classPrice",function() {
	calculateSum();
});

$("input[name=discount]").blur(function(){

	$('#discount_td').text(this.value);
	subtotal();
});
$("input[name=cgst]").blur(function(){

	$('#cgst_td').text(this.value);
	subtotal();
});
$("input[name=sgst]").blur(function(){

	$('#sgst_td').text(this.value);
	subtotal();
});
$("input[name=igst]").blur(function(){

	$('#igst_td').text(this.value);
	subtotal();
});

function subtotal(){
	var gross_total = $('#gross_total_td').html();
	var discount = $('#discount_td').html();

	//calculate subtotal
	var subtotal = (gross_total - ( gross_total * discount / 100 )).toFixed(2);
	$('#subtotal_td').text(subtotal);
	
	//calculate net amount
	var igst = $('#igst').val();
	var sgst = $('#sgst').val();
	var cgst = $('#cgst').val();

	var igst_td =  (parseInt(subtotal) * igst/100).toFixed(2); 
    var cgst_td = ((subtotal * cgst ) / 100 ).toFixed(2);
    var sgst_td = ((subtotal * sgst ) / 100).toFixed(2) ;
	var gst = '';
		
	  $('#igst_td').text(igst_td);
	  $('#sgst_td').text(sgst_td);
	  $('#cgst_td').text(cgst_td);

     gst = parseInt(igst_td) != '' ? parseInt(igst_td) : parseInt(cgst_td) + parseInt(sgst_td);
    var $net_amount = parseInt(gst) + parseInt(subtotal);
    $('#net_amount_td').text($net_amount);

    $('#subtotal').val($('#subtotal_td').html());
    $('#gross_total').val($('#gross_total_td').html());
    $('#cgst_amount').val(parseInt(cgst_td));
    $('#sgst_amount').val(parseInt(sgst_td));
    $('#igst_amount').val(parseInt(igst_td));
    $('#net_amount').val($net_amount); 

     
}