@extends('franchise.layouts.main')
@section('mains')
<!--<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>-->
    <!--start page wrapper -->
    <style>
    
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);
        body { margin: 0; padding: 0; }
        div, p, a, li, td { -webkit-text-size-adjust: none; }
        .ReadMsgBody { width: 100%; background-color: #ffffff; }
        .ExternalClass { width: 100%; background-color: #ffffff; }
        body { width: 100%; height: 100%; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        html { width: 100%; }
        p { padding: 0 !important; margin-top: 0 !important; margin-right: 0 !important; margin-bottom: 0 !important; margin-left: 0 !important; }
        .visibleMobile { display: none; }
        .hiddenMobile { display: block; }

    </style>
    
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			document.title = "Invoice"; window.print();

			document.body.innerHTML = originalContents;
        }
    </script>
    
    <?php
    
       
    
    
    
    
    ?>
    <div class="page-wrapper">
        <div class="page-content">
           <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo 'Stock Transfer Invoice'; ?></li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <hr />
            <div class="card" >
                <div class="card-body">
                <div class="row"> 
                     <div class="col-md-12"><?php echo Session::flash('message'); ?></div>
                </div>
             <div class="title-action">
                
                    <!--<a class="btn btn-warning">Edit Order </a>-->
                    <!--<a class="btn btn-large btn-success" title="Partial Payment"> Make Payment </a>-->
                    <a class="btn btn-large btn-primary" title="Partial Payment" onclick="printDiv('printableArea')">Print</a>
                    <!--<a class="btn btn-large btn-success" title="Partial Payment" onclick="generatePDF()">PDF Download</a>-->
                    <!--<a href="#cancel-bill" class="btn btn-danger" id="cancel-bill_p">Cancel </a>-->
                
                </div>   
            <!-- Header -->
            <div id="printableArea" width="900">
            
            <table width="100%" border="0"  style='margin-top:10px;background: #f7f7ff;' cellpadding="0" cellspacing="0" align="center" class="fullTable" >
              <tbody>
                <tr>
                  <td>
                    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style='margin-top: 10px;'>
                      <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                          <td height="10"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="10"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                              <tbody>
                                <tr>
                                  <td>
                                    <table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
            
                                      <tbody>
                                        <tr>
                                          <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                            
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr style='float: left;'>
                                          <td>
                                              <td align="left"> <img src="<?php echo url('/');?>/storage/app/logo/<?php print_r($data['0']->logo); ?>"  height="50" alt="logo" border="0" /></td>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
            
            
                                    <table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                      <tbody>
                                        <tr class="visibleMobile">
                                          <td height="20"></td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                             
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height=""></td>
                                        </tr>
                                        <tr>
                                      
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top;;">
                                                    <?php
                                                      $business=DB::table('business_setup')->where('id' , 1)->get();
                                                    ?>
                                                    <strong style='font-size:13px'><?php echo $business['0']->business_name ; ?></strong><br>
                                                    <?php
                                                    
                                                            print_r($business['0']->address);echo ',';
                                                            print_r($business['0']->city);echo ',';
                                                            print_r($business['0']->state);echo '-';print_r($business['0']->zip);
                                                            
                                                    ?>
                                                  
                                            </td>
                                        </tr>
                                      
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                       <tr class="hiddenMobile">
                          <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="30"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
           
            <!-- /Header -->
            <table width="100%" border="0"  style='background: #f7f7ff;' cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
              <tbody>
                <tr>
                  <td>
                    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                      <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                          <td height="10"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="10"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                              <tbody>
                                <tr>
                                  <td>
                                    <table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
            
                                      <tbody>
                                        <tr>
                                          <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                            <strong>BILLING INFORMATION</strong>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                            
                                            <div>
                                            <?php
                                                $to_id = $product_transfer_history['0']->to_id;
                                                $userss=DB::table('user')->where('id', $to_id)->get();
                                                echo $userss['0']->franchise_name;
                                                echo $userss['0']->address.'<br />';
                                                echo $userss['0']->contact.'<br />';
                                                echo $userss['0']->email.'<br />';
                                            ?>
                                            </div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
            
                                    
                                    <table width="250" border="0" style='margin-top: -12px' cellpadding="0" cellspacing="0" align="right" class="col">
                                      <tbody>
                                        <tr class="visibleMobile">
                                          <td height="10"></td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                              <strong>INVOICE</strong>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height=""></td>
                                        </tr>
                                        <tr>
                                      
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top;;">
                                                   
                                                    <small>Invoice No. </small> #&nbsp;<b><?php echo $product_transfer_history['0']->invoice_no; ?></b><br />
                                                    <small>Invoice Date. </small><b><?php echo date("D, d M Y", strtotime($product_transfer_history['0']->invoice_date)); ?></b><br>
                                                    <small>Print Date. </small><b><?php echo date("D, d M Y", strtotime(date('Y-m-d'))); ?></b>
                                            </td>
                                        </tr>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                  
                        <tr class="hiddenMobile">
                          <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="30"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- Order Details -->
            <table width="100%"  border="0" style='background: #f7f7ff;' cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
              <tbody>
                <tr>
                  <td>
                    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                      <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                          <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="40"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                              <tbody>
                                <tr>
                                  <th>
                                    Item
                                  </th>
                                  <th>
                                    <small>SKU Code</small>
                                  </th>
                                  <th style='text-align:center'>
                                    Quantity
                                  </th>
                                    <th style='text-align:center'>
                                    Price
                                  </th>
                                     <th style='text-align:center'>
                                    DIS
                                  </th>
                                    <th style='text-align:center'>
                                    Total
                                  </th>
                                   <th style='text-align:center'>
                                    CGST
                                  </th>
                                  
                                   <th style='text-align:center'>
                                    SGST
                                  </th>
                                  
                                 
                                   <th style='text-align:center'>
                                    IGST
                                  </th>
                                  
                                  <th style='text-align:center'>
                                    Grand Total
                                  </th>
                                 
                                  <th style='text-align:center'>
                                    Total BV
                                  </th>
                                 
                                
                                </tr>
                                <tr>
                                  <td height="1" style="background: #bebebe;" colspan="11"></td>
                                </tr>
                                <tr>
                                  <td height="10" colspan="11"></td>
                                </tr>
                                
                                <?php
                                
                                    $subtotal=0;
                                    $totalshipping=0;
                                    $totalcgst=0;
                                    $totaligst=0;
                                    $totalsgst=0;
                                    $totalbv=0;
                                    // $res=json_decode($r_orders['0']->products, true);
                                    // $shippingAddress=json_decode($r_orders['0']->shipping_address, true);
                                    
                                    // foreach($res as $row){
                                    // $products=DB::table('products')->where('id' , $row['id'])->get();
                                    // $total=($row['mrp']-($row['mrp']*$products['0']->percent_discount)/100)*$row['quantity'];
                                    // $perquantityDiscount=$row['mrp']-($row['mrp']*$products['0']->percent_discount)/100;
                                    // $subtotal+=$total;
                                    // $totalshipping+=$row['quantity']*$products['0']->shipping_charge;
                                    // if($shippingAddress['0']['state']=='Uttar Pradesh'){
                                        
                                    //     $cgst=$products['0']->gst/2; 
                                    //     $sgst=$products['0']->gst/2;
                                    //     $igst='00.00';
                                    
                                    // }else{
                                    //     $igst=$products['0']->gst; 
                                    //     $sgst='00.00';
                                    //     $cgst='00.00';
                                    // } 
                                    // $DP=(($row['mrp']*$products['0']->percent_discount)/100);
                                    // $totalcgst+=(($perquantityDiscount*$cgst)/100)*$row['quantity'];
                                    // $totaligst+=(($perquantityDiscount*$igst)/100)*$row['quantity'];
                                    // $totalsgst+=(($perquantityDiscount*$sgst)/100)*$row['quantity'];
                                    // $totalgst=$totalcgst+$totaligst+$totalsgst;
                                    
                                    // $grandtotal=$total+(($perquantityDiscount*$cgst)/100)*$row['quantity']+(($perquantityDiscount*$sgst)/100)*$row['quantity']+(($perquantityDiscount*$igst)/100)*$row['quantity'];
                                    
                                    // $totalbv+=$products['0']->business_value*$row['quantity'];
                                ?>
                                
                        <?php
                            $total_quantity = 0;
                            $total_business_value=0;
                            $total_sp=0;
                            $i=1;
                            $product_details = json_decode($product_transfer_history['0']->product_details,1);
                            foreach($product_details as $rows){
                                $productss=DB::table('products')->where('id' , $rows['id'])->get();
                                $usrss=DB::table('user')->where('id' , $product_transfer_history['0']->to_id)->get();
                                
                                $product_name=$productss['0']->product_name;
                                $sku_code=$productss['0']->sku_code;
                                $price=$productss['0']->mrp;
                                $business_value=$productss['0']->business_value;
                                $total_business_value += $business_value;
                                $quantity=$rows['quantity'];
                                $total_quantity +=$quantity;
                                $total_price= $quantity*$price;
                                
                                if(!empty($productss['0']->percent_discount)){
                                    $DP=(($price*$productss['0']->percent_discount)/100);
                                    $total=($price-($price*$productss['0']->percent_discount)/100)*$quantity;
                                    $perquantityDiscount=$price-($price*$productss['0']->percent_discount)/100;
                                    $discount=$productss['0']->percent_discount.'%';
                                }
                                
                                if(!empty($productss['0']->flat_discount)){
                                    $DP=$productss['0']->flat_discount;
                                    $total=($price-$productss['0']->flat_discount)*$quantity;
                                    $perquantityDiscount=$price-$productss['0']->flat_discount;
                                    $discount=$productss['0']->flat_discount;
                                }
                                
                                
                                
                                
                                $subtotal+=$total;
                                $totalshipping+=$quantity*$productss['0']->shipping_charge;
                                
                                if($usrss['0']->state=='Uttar Pradesh'){
                                        
                                        $cgst=$productss['0']->gst/2; 
                                        $sgst=$productss['0']->gst/2;
                                        $igst='00.00';
                                    
                                    }else{
                                        $igst=$productss['0']->gst; 
                                        $sgst='00.00';
                                        $cgst='00.00';
                                    }
                                $totalcgst+=(($perquantityDiscount*$cgst)/100)*$quantity;
                                $totaligst+=(($perquantityDiscount*$igst)/100)*$quantity;
                                $totalsgst+=(($perquantityDiscount*$sgst)/100)*$quantity;
                                $totalgst=$totalcgst+$totaligst+$totalsgst;
                                $grandtotal=$total+(($perquantityDiscount*$cgst)/100)*$quantity+(($perquantityDiscount*$sgst)/100)*$quantity+(($perquantityDiscount*$igst)/100)*$quantity;
                                $totalbv+=$productss['0']->business_value*$quantity;
                                ?>
                               
                  
                                <tr>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif;line-height: 18px;  vertical-align: top; padding:10px 0;width:110px" class="article">
                                   <?php  echo $product_name;echo "<br>" ?>
                                   &nbsp;&nbsp;<small style=' color: #ff0000; '><?php  echo $discount;echo ' ';  echo "OFF" ?></small>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                      <small><?php  echo $sku_code;; ?></small>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <?php echo $quantity;?>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                       <?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $price; ?>
                                  </td>
                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                        <?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $DP; ?>
                                  </td>
                                   <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $total; ?>
                                  </td>
                                   <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <?php echo $cgst; echo "/"; ?><b style='font-size:12px'>&nbsp;₹&nbsp;<?php echo (($perquantityDiscount*$cgst)/100)*$quantity;?></b>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <?php echo $sgst; echo "/"; ?><b style='font-size:12px'>&nbsp;₹&nbsp;<?php echo (($perquantityDiscount*$sgst)/100)*$quantity;?></b>
                                  </td>
                                   <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                       <?php echo $igst; echo "/"; ?><b style='font-size:12px'>&nbsp;₹&nbsp;<?php echo (($perquantityDiscount*$igst)/100)*$quantity;?></b>
                                  </td>
                                  
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                       <?php //echo $igst; echo "/"; ?><b style='font-size:12px'>&nbsp;₹&nbsp;<?php echo $grandtotal;?></b>
                                  </td>
                                  
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                       <?php //echo $igst; echo "/"; ?><b style='font-size:12px'>&nbsp;<?php  echo $productss['0']->business_value*$quantity;?></b>
                                  </td>
                                  
                                
                                
                                </tr>
                                <tr>
                                  <td height="1" colspan="11" style="border-bottom:1px solid #e4e4e4"></td>
                                </tr>
                                <?php } ?>
                                
                                
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td height="20"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- /Order Details -->
            <!-- Total -->
            <table width="100%"  border="0" style='background: #f7f7ff;'  cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
              <tbody>
                <tr>
                  <td>
                    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                      <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                          <td height="10"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="10"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style='margin-left: 300px;' class="fullPadding">
                              <tbody>
                                <tr>
                                    <th style='text-align:center'>
                                     Subtotal
                                    </th>
                                    <th style='text-align:center'>
                                     Total Shipping Charge
                                    </th>
                                    <th style='text-align:center'>
                                     Total GST
                                    </th>
                                    <th style='text-align:center'>
                                     Net Total
                                    </th>
                                    <th style='text-align:center'>
                                     Total BV
                                    </th>
                                </tr>
                                <tr>
                                  <td height="1" style="background: #bebebe;" colspan="5"></td>
                                </tr>
                                <tr>
                                  <td height="10" colspan="5"></td>
                                </tr>
                               
                                
                                <tr>
                                  
                                   <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                        <b><?php echo $data['0']->currency_symbol;?>&nbsp;   <?php echo $subtotal; ?> </b>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                        <b><?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $totalshipping; ?>  </b>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                       <b><?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $totalgst; ?>  </b>
                                  </td>
                                  <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <b><?php echo $data['0']->currency_symbol;?>&nbsp;<?php echo $totalshipping+$totalgst+$subtotal; ?></b>
                                  </td>
                                   <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align:center">
                                      <b><?php echo $totalbv; ?></b>
                                  </td>
                                </tr>
                              
                                <tr>
                                  <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td height="20"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table width="100%" border="0" style='background: #f7f7ff;'  cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
              <tbody>
                <tr>
                  <td>
                    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff"  style='margin-bottom: 10px;' >
                      <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                          <td height="50"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="10"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding" style='margin-buttom: 10px;'>
                              <tbody>
                                <tr>
                                  <td>
                                    <table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
            
                                      <tbody>
                                        <tr>
                                          <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                            <strong>Amount Chargeable (in words):</strong>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                <small><b><?php
                                                $f=new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $charchter_amount= $f->format(round($totalshipping+$totalgst+$subtotal));
                                                echo "Rupees:- ".ucwords($charchter_amount)." (".round($totalshipping+$totalgst+$subtotal).")";
                                                ?> </b></small>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
            
            
                                    <table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                      <tbody>
                                        <tr class="visibleMobile">
                                          <td height="20"></td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                              <strong>Authorized Signatory</strong>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="100%" height=""></td>
                                        </tr>
                                        <tr>
                                      
                                        <tr>
                                          <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top;;">
                                                 <img src='<?php echo url("/")?>/storage/app/Sample-sign-2a.png' width='300'>
                                            </td>
                                        </tr>
                                      
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr class="hiddenMobile">
                          <td height="60"></td>
                        </tr>
                        <tr class="visibleMobile">
                          <td height="30"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
           
          </div>
            </div>
        </div>
    </div>

              
@endsection
