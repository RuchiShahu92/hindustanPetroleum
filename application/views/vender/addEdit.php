<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Vender Management
        <small>Add / Edit Vender</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Vender Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addVender" action="<?php echo base_url() ?><?php echo !empty($editRecord['id'])? 'updateVender' : 'addVender' ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" value="<?php echo  !empty($editRecord['name']) ? $editRecord['name']:'' ?>">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control required" name="address" > <?php echo  !empty($editRecord['address']) ? $editRecord['address']:'' ?> </textarea>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">Pin Code	</label>
                                        <input type="text" class="form-control required" value="<?php echo  !empty($editRecord['pincode']) ? $editRecord['pincode']:'' ?>" id="pincode" name="pincode" maxlength="6">
                                    </div>
                                </div> 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_no">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="phone_no" value="<?php echo  !empty($editRecord['phone_no']) ? $editRecord['phone_no']:'' ?>"name="phone_no" maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden"  name="id" value="<?php echo  !empty($editRecord['id']) ? $editRecord['id']:'' ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a class="btn btn-default" href="<?php echo base_url().'venderListing'; ?>">Cancel</a>
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
<script src="<?php echo base_url(); ?>assets/js/addVender.js" type="text/javascript"></script>