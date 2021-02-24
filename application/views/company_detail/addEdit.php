<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Company Management
        <small>Add / Edit Company</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Company Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addCompanyDetail" action="<?php echo base_url() ?><?php echo !empty($editRecord['id'])? 'updateCompany' : 'addCompany' ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control required" id="company_name" name="company_name" value="<?php echo  !empty($editRecord['company_name']) ? $editRecord['company_name']:'' ?>">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="text" class="form-control required email" id="email"  name="email" value="<?php echo  !empty($editRecord['email']) ? $editRecord['email']:'' ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control required" name="address" > <?php echo  !empty($editRecord['address']) ? $editRecord['address']:'' ?> </textarea>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">Pin Code</label>
                                        <input type="text" class="form-control required" value="<?php echo  !empty($editRecord['pincode']) ? $editRecord['pincode']:'' ?>" id="pincode" name="pincode" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="row">  
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="phone_no" value="<?php echo  !empty($editRecord['phone_no']) ? $editRecord['phone_no']:'' ?>"name="phone_no" maxlength="10">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">gst_no	</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($editRecord['gst_no']) ? $editRecord['gst_no']:'' ?>" id="gst_no" name="gst_no" >
                                    </div>
                                </div> 
                            </div>
							 <div class="box-header">
								<h3 class="box-title">Enter GST/Tax Details</h3>
							</div>
							<?php 
							$taxDetail = !empty($editRecord['bank_details'])?  unserialize($editRecord['tax_detail']):'';
				 
							?>
							 <div class="row"> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no">CGST %</label>
                                        <input type="text" class="form-control required" id="CGST" value="<?php echo  !empty($taxDetail['CGST']) ? $taxDetail['CGST']:'' ?>"name="tax_arr[CGST]"  >
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">SGST %</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($taxDetail['SGST']) ? $taxDetail['SGST']:'' ?>" id="SGST" name="tax_arr[SGST]" >
                                    </div>
                                </div>
                              </div>
							 <div class="row"> 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">IGST %</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($taxDetail['IGST']) ? $taxDetail['IGST']:'' ?>" id="IGST" name="tax_arr[IGST]" >
                                    </div>
                                </div>
                            </div>
							
							 <div class="box-header">
								<h3 class="box-title">Enter Bank Details</h3>
							</div>
							<?php 
							
							$bankDetail = !empty($editRecord['bank_details'])? unserialize($editRecord['bank_details']):'';
						 
							?>
							 <div class="row"> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no">Name</label>
                                        <input type="text" class="form-control required" id="name" value="<?php echo  !empty($bankDetail['name']) ? $bankDetail['name']:'' ?>"name="bank_arr[name]"  >
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">  Branch	</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($bankDetail['branch']) ? $bankDetail['branch']:'' ?>" id="branch" name="bank_arr[branch]" >
                                    </div>
                                </div>
                            </div>
							<div class="row"> 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">Account No.	</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($bankDetail['account_no']) ? $bankDetail['account_no']:'' ?>" id="account_no" name="bank_arr[account_no]" >
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">IFCA Code	</label>
                                        <input type="text" class="form-control required" value="<?php echo !empty($bankDetail['ifca_code']) ? $bankDetail['ifca_code']:'' ?>" id="ifca_code" name="bank_arr[ifca_code]" >
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
            <div class="col-md-4">
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
<script src="<?php echo base_url(); ?>assets/js/addCompanyDetail.js" type="text/javascript"></script>