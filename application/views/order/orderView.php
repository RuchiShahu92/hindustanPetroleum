<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Order Management	
        <small>Order View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url('file_download/'). $orderView['id'] ?>"><i class="fa fa-print"></i> Print</a>
                </div>
                  <div class="form-group"> Status
                  <select  class="form-group" id="order_status">
                    <option>select order status</option>
                    <option <?php if($orderView['order_status'] == 'pending'): ?> selected="selected"<?php endif; ?>  value="pending">Pending</option>
                    <option value="paid"  <?php if($orderView['order_status'] == 'paid'): ?> selected="selected"<?php endif; ?>>Paid</option>
                    <option value="cancel" <?php if($orderView['order_status'] == 'cancel'): ?> selected="selected"<?php endif; ?>>Cancel</option>
                  </select>
                   <button class="btn btn-primary" onclick="status_change('<?php echo $orderView['id']?>')" >Status Change</button>
               
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h1 class="box-title">Order View</h1>
                    <div class="box-tools">
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <fieldset>
                    <legend>Order Items:</legend>
                  <table class="table table-hover">
                    <tr>
                      <th>Sr No.</th>
                      <th>Particulars </th>
                      <th>Qty</th> 
                      <th>Amount</th> 
                    </tr>
                    <?php
                    if(!empty($orderItemView))
                    {
                        foreach($orderItemView as $record)
                        {   
                    ?>
							<tr>
							  <td><?php echo $record['id'] ?></td>
							  <td><?php echo $record['product_name'] ?></td>
							  <td><?php echo $record['product_qty'] ?></td> 
							  <td><?php echo $record['product_price'] ?></td>  
							  
							</tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  </fieldset>
                   <fieldset>
                    <legend>Order Total:</legend>
                    <table class="table table-hover" text-align="right">
                    <?php
                    if(!empty($orderView))
                    { ?>
                          <tr>
                            <td></td><td></td>
                            <td><strong>Gross Total</strong></td>
                            <td><?php echo $orderView['gross_total'] ?></td>
                          </tr>
                          <tr>
                            <td></td><td></td>
                            <td><strong>Discount</strong></td>
                            <td><?php echo $orderView['discount'] ?></td>
                          </tr>
                          <tr>
                             <td></td><td></td>
                            <td><strong>Sub Total</strong></td>
                            <td><?php echo $orderView['sub_total'] ?></td>
                          </tr>
                          <tr>
                             <td></td><td></td>
                            <td><strong>CGST</strong></td>
                            <td><?php echo $orderView['cgst_amount'] ?></td>
                          </tr>
                          <tr>
                             <td></td><td></td>
                            <td><strong>SGST</strong></td>
                            <td><?php echo $orderView['sgst_amount'] ?></td>
                          </tr>
                          <tr>
                             <td></td><td></td>
                            <td><strong>IGST</strong></td>
                            <td><?php echo $orderView['igst_amount'] ?></td>
                          </tr>
                          <tr>
                            <td></td><td></td>
                            <td><strong>Net Amount</strong></td>
                            <td><?php echo $orderView['net_amount'] ?></td>
                          </tr>
                  <?php }
                ?>
                    </table>  
                  </fieldset>

                </div><!-- /.box-body -->
                 
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
  $(function(){
  $('.downloadable').click(function(){

     window.location.href = "<?php echo base_url('order/file_download') ?>?file_name="+ $(this).attr('href');
  });


});
  function status_change(id){
     if (confirm('Are you sure you want to change order status?')) {
        $.ajax({
            url: "<?php echo base_url('status_change')?>",
            type: "POST",
            data: { id:id ,order_status: $('#order_status option:selected').val() },
            success: function () {
                alert("status change successfully.");
                window.location.reload(true);
            }
        });
  }
  }
</script>
