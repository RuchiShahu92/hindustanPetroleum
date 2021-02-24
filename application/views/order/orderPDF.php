<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <style>
table {border-collapse: collapse;}
table td {padding: 0px}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
  </style>

</head>
<body>

<table style="width:100%" border="">
  <tr>
    <th>Sr.No </th>
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
                     <tr>
    <td> &nbsp;</td>
    <td>&nbsp; </td>
    <td> &nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>GST NO</td>
    <td>24CHJPS2416L1Z3 </td>
    <td><strong>Gross Total</strong></td>
    <td><?php echo $orderView['gross_total'] ?></td>
  </tr>
  <tr>
    <td>Bank</td>
    <td>THE SARANGPUR CO-OP BANK </td>
    <td><strong>Discount</strong></td>
    <td><?php echo $orderView['discount'] ?></td>
  </tr>
  
  <tr>
    <td>Branch</td>
    <td>ELLIS BRIDGE </td>
    <td><strong>Sub Total</strong></td>
    <td><?php echo $orderView['sub_total'] ?></td>
  </tr>
  <tr>
    <td>Ac/No</td>
    <td>OO211O1O1OO2386 </td>
    <td><strong>CGST</strong></td>
    <td><?php echo $orderView['cgst_amount'] ?></td>
  </tr>
  <tr>
    <td>IFSC Code</td>
    <td>HDFC0CTSCBL </td>
    <td><strong>SGST</strong></td>
    <td><?php echo $orderView['sgst_amount'] ?></td>
  </tr>
   <tr>
    <td></td>
    <td> </td>
    <td><strong>IGST</strong></td>
    <td><?php echo $orderView['igst_amount'] ?></td>
  </tr>
   <tr>
    <td></td>
    <td> </td>
    <td><strong>Net Amount</strong></td>
    <td><?php echo $orderView['net_amount'] ?></td>
  </tr>
</table>

</body>
</html>
