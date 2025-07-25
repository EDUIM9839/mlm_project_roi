 @extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
         <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title1 }}</li>
                        </ol>
                    </nav>
                </div>
              
            </div>
            <!--end breadcrumb-->
        
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="toolbar">
                        <div class="row">
                        <div><p>Abhi Ye work nahi kar raha (<b></b>Puri tarah se setup nahi hai</b>)</p></div> <br><br><br>
                        <form method="post" id='myform' action="{{ route('adminOrder') }}">
                            @csrf
                            <div class='col-md-12'>
                                <div class="text">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Bill To</h5>
                                            <div style="margin-top: 50px">
                                                <label>Search Client</label>
                                              <input type="text" style="margin-top:5px"   name="search_client" id="search_client"  onkeyup="getusers();" class="form-control">
                                                <small style="color:red">
                                                  @error('search_client')
                                                      {{ $message }}
                                                  @enderror
                                                </small>
                                            </div>
                                            <div style="margin-top:2px;">
                                                <ul  style="display:none" class="list-group" id="searchDatas">
                                               </ul>
                                                
                                            </div>
                                            <div id="customer" style="margin-top: 30px">
                                             <div class="clientinfo">
                                                    Client Details  <hr>
                                                <input type="text" name="customer_id" id="customer_id">
                                                <input type="text" name="customer_name" id="customer_name">
                                                <input type="text" name="customer_address" id="customer_address">
                                                <input type="text" name="city" id="city">
                                                <input type="text" name="state" id="state">
                                                <input type="text" name="zip" id="zip">
                                                <input type="text" name="customer_phone" id="customer_phone">
                                                <input type="text" name="customer_email" id="customer_email">
                                                    <div><strong id="customer_name"></strong></div>
                                                </div>
                                                <div class="clientinfo">
                                             <div><strong id="customer_address"></strong></div>
                                                </div>
                                                <div class="clientinfo">
                                                    <div><strong id="city"></strong><strong id="state"></strong><strong id="zip"></strong></div>
                                                </div>
                                                    <div class="clientinfo">
                                                        <div > <strong id="customer_phone"></strong><br><strong id="customer_email"></strong></div>
                                                </div>
                                              </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h5>Invoice Properties</h5>
                                            <div class="inner-cmp-pnl" style="margin-top: 55px">

                                                <div class="form-group row">
                                                    <div class="col-sm-12"><label for="invocieno" class="caption">Invoice Number</label>
                                                        <?php 
                                                            function generate_numbers($start, $count, $digits) {
                                                                $result = array();
                                                                for ($n = $start; $n < $start + $count; $n++) {
                                                                    $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
                                                                }
                                                                
                                                                return 'DSC_'.$result['0'];
                                                                }
                                                                $numbers = generate_numbers($invoiceno+1, 1, 8);
                                                        ?>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><span class="icon-file-text-o" aria-hidden="true"></span></div>
                                                            <input type="hidden" class="form-control"  name="invocieno"  value='<?php echo $numbers; ?>'>
                                                            <input type="text" class="form-control"  placeholder="<?php echo $numbers; ?>" >
                                                            <small style="color:red">
                                                                @error('invocieno')
                                                                    {{ $message }}
                                                                @enderror
                                                              </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                
                                                    <div class="col-sm-12"><label for="invociedate" class="caption">Invoice Date</label>
                
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><span class="icon-calendar4" aria-hidden="true"></span></div>
                                                            <input type="date" class="form-control required" placeholder="Billing Date" value="{{ old('invoicedate') }}" name="invoicedate" data-toggle="datepicker" autocomplete="false">
                                                            
                                                        </div>
                                                        <small style="color:red">
                                                            @error('invoicedate')
                                                                {{ $message }}
                                                            @enderror
                                                          </small>
                                                    </div>
                                                    
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="taxformat" class="caption">Gst</label>
                                                        <select class="form-control" name="gst" onchange="changeGst(this.value)" id="gst">
                                                            <option value=''>--Select Gst--</option> 
                                                            <option value="IGST">IGST</option>
                                                            <option value="SGST">SGST</option>
                                                            <option value="CGST">CGST</option>
                                                            <option value="UTGST">UTGST</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                
                                                        <div class="form-group">
                                                            <label for="discountFormat" class="caption"> Discount</label>
                                                            <select class="form-control" onchange="changeDiscount(this.value)" id="getAlldiscount">
                                                                <option value="">--Select Discount--</option> 
                                                                <option value="flat_discount">Flat Discount</option>
                                                                <option value="discount">% Discount</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="toAddInfo" class="caption">Invoice Note</label>
                                                        <textarea class="form-control" name="notes" rows="2"></textarea>
                                                        <small style="color:red">
                                                            @error('notes')
                                                                {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </div>
                                                </div>
                
                                            </div>
                                        </div>

                                    
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-12" style="margin-top:30px">
                                <div class="table-responsive text-nowrap" style="padding:10px">
                                <table class="table">
                                <tbody>
                                    <tr class='table-dark'>
                                        <th>Product Name</th>
                                        <th>Bill Type</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>SP</th>
                                        <th>SV</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </tbody>
                                 <tbody id="productsssss">
                                    
                                </tbody>
                                                                                
                                </table>
                                </div>
                                
                                    <div class="row">
                                            
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">

                                             <div class="table-responsive text-nowrap" style="padding:10px">
                                                <table class="table">
                                                <tbody>
                                                   <tr class='table-dark'>
                                                        <th>Sub Total</th>
                                                        <th>Total SP</th>
                                                        <th>Total SV</th>
                                                        <th>Total</th>
                                                        
                                                    </tr>
                                                </tbody>
                                                 <tbody>
                                                    <tr>
                                                        <td id="subtotal"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;0</td>
                                                        <td id="total_sp1"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;0</td>
                                                        <td id="total_bv1"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;0</td>
                                                        <td id="total"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;0</td>
                                                    </tr>
                                                </tbody>
                                                                                                
                                                </table>
                                                </div>

                                            </div>
                                        </div>

                                    
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 >Wallet Amount: ₹ <span id="wallet"></span></h5>
                                        </div>
                                    </div>
                                  
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-md-6 gip" style="display:noneaa" >
                                            <select name="payment_method" class="form-control" id="button_status">
                                                <option value="cod">Cash / UPI</option>
                                                <option value="wallet">Wallet</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 gip" style="display:noneaa" >
                                            <input type="submit" style="float: right;" class="btn btn-success sub-btn" value="Generate Invoice"  id="submit-data">
                                        </div>
                                        
                                    </div>  
                            
                                    
                                </div>
                                
                            
                            <br>
                           
                            <input type="hidden" name="quantity" id="total_quantity">
                            <input type="hidden" name="total" id="total_amount">
                            <input type="hidden" name="total_bv" id="total_bv">
                            <input type="hidden" name="total_sp" id="total_sp">
                            <input type="hidden" name="products" id="all_products">
                            <input type="hidden" name="sell_from" value="57">

                            {{-- <button type="submit" class="btn btn-primary" name="payment_method" value="cod">Cash / UPI</button>
                            <button type="submit" class="btn btn-primary" name="payment_method" value="wallet" id="button_status" style="margin-left: 10px;">Wallet</button> --}}
                           
                        
                    </form>

                    </div>
                     
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

























































