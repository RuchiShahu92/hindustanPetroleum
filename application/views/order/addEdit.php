<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Order Management
        <small>Add / Edit Company</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
              <!-- general form elements -->
                  
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Order Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addOrderDetail" action="<?php echo base_url() ?><?php echo !empty($editRecord['id'])? 'updateOrder' : 'addOrder' ?>" method="post" role="form">
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="name">Company</label>
                                         <?php //set_value("company_id",isset($display_data->id) && !empty($display_data->id) ? $display_data->id : '')
                                         echo getcombo("company_detail","  ","id","company_name",'',"company_id","required"); ?>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vender">Vender</label>
                                         <?php //set_value("company_id",isset($display_data->id) && !empty($display_data->id) ? $display_data->id : '')
                                         echo getcombo("vender","  ","id","name",'',"vender_id","required"); ?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount">Discount (%)</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($editRecord['discount']) ? $editRecord['discount']:'' ?>" id="discount" name="discount" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gst_type">GST Type</label>
                                        <input name="gst_type" type="radio" class="required" value="2" <?= !empty($editRecord['gst_type']) ? ($editRecord['gst_type'] == 2) ? 'checked=checked' : '' : ''; ?>>CGST/SGST  
                                        <input name="gst_type" type="radio" class="required" value="1" <?= !empty($editRecord['gst_type']) ? ($editRecord['gst_type'] == 1) ? 'checked=checked' : '' : ''; ?>>IGST 
                                    </div>
                                </div>

                                <div id="gst_div" style="display:none">
                                    <div class="col-md-4">                                
                                        <div class="form-group">
                                            <label for="cgst">CGST</label>
                                            <input type="text" class="form-control required" value="<?php echo !empty($editRecord['cgst']) ? $editRecord['cgst']:'' ?>" id="cgst" name="cgst" >
                                    
                                      </div>
                                    
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sgst">SGST</label>
                                             <input type="text" class="form-control required" value="<?php echo !empty($editRecord['sgst']) ? $editRecord['sgst']:'' ?>" id="sgst" name="sgst" >
                                    
                                       </div>
                                    </div>
                                </div>
                                <div id="igst_div" style="display:none">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sgst">IGST</label>
                                             <input type="text" class="form-control required" value="<?php echo !empty($editRecord['igst']) ? $editRecord['igst']:'' ?>" id="igst" name="igst" >
                                    
                                       </div>
                                    </div>
                                </div>

                            </div>
							<div class="">
                            <div class="row after-add-more">
								 <div class="col-md-12" >
									<div class="col-md-4">
										 <div class="form-group">
											<label for="product_name">Product Name	</label>
											<input type="text" class="form-control required" value="<?php echo !empty($editRecord['gst_no']) ? $editRecord['gst_no']:'' ?>" id="product_name" name="product_name[]" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="product_qty">Qty </label>
											<input type="text" class="form-control required" value="<?php echo !empty($editRecord['gst_no']) ? $editRecord['gst_no']:'' ?>" id="product_qty" name="product_qty[]" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="product_price">Price </label>
											<input type="text" class="form-control required classPrice" value="<?php echo !empty($editRecord['gst_no']) ? $editRecord['gst_no']:'' ?>" id="product_price" name="product_price[]" >
										</div>
									</div>
								</div> 
                            </div> 
                            </div> 
                            <div class="row">
									<div class="col-md-6">           
										 <div class="form-group">
										 <label for=" "> &nbsp; &nbsp; &nbsp;	</label>
										  <button type="button" class="btn btn-sm btn-info" onclick="add_more_product();" ><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
										  </div> 
									</div>   
                               </div>
							<div class="row">
                                 <div class="col-md-12"> 
                                   <table class="table table-bordered">

                                    <tbody>
                                        
                                    <tr>
                                        <td>Gross Total</td>
                                        <td id="gross_total_td">0</td> 
                                        <input type="hidden" name="gross_total" id="gross_total" value="" class="form-control">
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td id="discount_td">0</td> 
                                    </tr>
                                    <tr>
                                        <td>Sub total</td>
                                        <td id="subtotal_td">0</td>
                                          <input type="hidden" name="subtotal" id="subtotal" value="" class="form-control">
                                    </tr>
                                    <tr>
                                        <td>CGST</td>
                                        <td id="cgst_td">0</td>
                                        <input type="hidden" name="cgst_amount" id="cgst_amount" value="" class="form-control">

                                    </tr>
                                    <tr>
                                        <td>SGST</td>
                                        <td id="sgst_td">0</td>
                                        <input type="hidden" name="sgst_amount" id="sgst_amount" value=""  class="form-control">

                                    </tr>
                                    <tr>
                                        <td>IGST </td>
                                        <td id="igst_td">0</td>
                                        <input type="hidden" name="igst_amount" id="igst_amount" value="" class="form-control">
                                    </tr>
                                    <tr>
                                        <td>Net Amount </td>
                                        <td id="net_amount_td">0</td>
                                        <input type="hidden" name="net_amount" id="net_amount" value="" class="form-control">
                                    </tr>
                                    </tbody>
                                    </table>
                                   </div> 
                                </div>    
                            </div>     
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden"  name="id" value="<?php echo  !empty($editRecord['id']) ? $editRecord['id']:'' ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a class="btn btn-default" href="<?php echo base_url().'companyListing'; ?>">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addOrder.js" type="text/javascript"></script>