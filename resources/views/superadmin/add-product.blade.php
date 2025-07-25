@extends('superadmin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.ck.ck-editor{
    width:100%;
}
</style>

    <div class="page-wrapper">
        <div class="page-content">
              <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('product-list')}}" class='badge bg-info'>Product List</a></h6>
                </div>
            </div>
            <!--end breadcrumb-->
            
            
            
             <div class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                      <div class="row"> <div class="col-md-12"><?php //echo session()->get('message'); ?></div></div>
                    <form action="<?php if(!empty($data['0']->id)){?>{{ route('update_product') }}<?php } else{ ?>{{ route('save_product') }} <?php } ?>" method="post" enctype="multipart/form-data">
                        @csrf
                      <h4 align='right'> <span style='font-size:18px;' >First Product : </span><label class="switch">
                          <input type="checkbox" name="first_or_repurchase">
                          <span class="slider"></span>
                        </label>
                         </h4>
             <div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                                    <label class="form-label">Product Name:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->product_name }}" name="product_name" placeholder="Enter Product Name">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="product_name"  value="{{ old('product_name') }}" placeholder="Enter Product Name">
                                    <?php } ?>   
                                    
                                    @error('product_name')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          
                            <div class="col-md-12 mt-3">
                                {{-- <input type="hidden" class="form-control" value="AP002" name="referal"  id="referal"> --}}
                                <?php if(!empty($data['0']->id)){?>
                                    <input type="hidden" class="form-control" value="{{ $data['0']->id }}" name="id"  id="id">
                                <?php } ?>
                               
                                <div class="mb-3">
                                    <label class="form-label">Select Category:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-note'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <select class="form-control" name="category_id">
                                            <option value=''>--Select Category--</option>
                                            <?php foreach($category as $row){ ?>
                                                <option value="{{ $row->id }}" <?php if($row->id==$data['0']->category_id){ 'selected'; }?>><?php print_r($row->category_name); ?></option>
                                            <?php } ?>
                                          </select>
                                    <?php } else{ ?>
                                        
                                      <select class="form-control" name="category_id"  id="category_id"  onchange="getsubcategory(this.value);">
                                        <option value=''>--Select Category--</option>
                                        <?php foreach($category as $row){ ?>
                                            <option value="{{ $row->id }}"><?php print_r($row->category_name); ?></option>
                                        <?php } ?>
                                      </select>
                                    <?php } ?>     
                                    
                                    @error('category_id')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <?php if(!empty($data['0']->id)){?>
                                    <input type="hidden" class="form-control" value="{{ $data['0']->id }}" name="id"  id="id">
                                <?php } ?>
                               
                                <div class="mb-3">
                                    <label class="form-label">Select Sub Category:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                                         
                                          </select>
                                    <?php } else{ ?>
                                        
                                      <select class="form-control" name="subcategory_id" id="subcategory_id">
                                       
                                      </select>
                                    <?php } ?>     
                                    
                                    @error('subcategory_id')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                           
                     
                        <div class="col-md-12">
                            <div class="mb-3">
                                
                                
                                 
                                <?php if(!empty($data['0']->id)){?>
                                   
                                <?php } else{ ?>
                                    <label class="form-label">Product Image:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-image'></i></span>
                                    <input type="file"  accept="image/*" class="form-control" name="image">
                                <?php } ?>  
                                @error('images')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                     
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">MRP (₹):</label>
                                   
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->mrp }}" name="mrp"  placeholder="Enter MRP">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="mrp"  value="{{ old('mrp') }}" id="mrp" placeholder="Enter MRP">
                                    <?php } ?> 
                                    
                                    @error('mrp')
                                        <small style="color:red">{{ $message }}</small>
                                     @enderror
                                </div>
                            </div>
                           
                        </div>
                        


                        
                     
                      
                        
                       <div class="row">
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Discount Type:</label>
                                    <div class="row input-group">  
                                        <div class='col-md-2'>
                                       <input type='radio' id='percent' class="discount-type" name="discount-type" value="percent">  <label for="percent"><b>Percent</b></label> 
                                       </div>
                                       <div class='col-md-2'>
                                       <input type='radio' id='flat'  checked class="discount-type" name="discount-type" value="flat">  <label for="flat" ><b>Flat</b></label> 
                                       </div>
                                    @error('discount-type')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            </div>
                          
                        </div>



                           
                        <div id="percent-div" style='display:none;'>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Discount (%):</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->discount }}" name="percent_discount" placeholder="Enter Discount" id="discount">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="percent_discount"  placeholder="Enter Discount" value="{{ old('discount') }}" id="discount">
                                    <?php } ?>  
                                    @error('discount')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            </div>
                          
                        </div>


                        <div id="flat-div"   >
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Flat Discount:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->flat_discount }}" name="flat_discount" placeholder="Enter Flat Discount" id="flat_discount">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="flat_discount"  placeholder="Enter Flat Discount" value="{{ old('flat_discount') }}" id="flat_discount">
                                    <?php } ?>  
                                    @error('flat_discount')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            </div>
                          
                        </div>

                        <div  >
                           
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Gst (%):</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <select id="gst" name="gst" class="form-control">
                                            <option value=" ">--Select Gst--</option>
                                            <option value="6" <?php if($data['0']->gst==6){ echo 'selected'; }?>>6 % </option>
                                            <option value="12" <?php if($data['0']->gst==12){ echo 'selected'; }?>>12 % </option>
                                            <option value="18" <?php if($data['0']->gst==18){ echo 'selected'; }?>>18 % </option>
                                        </select>
                                    <?php } else{ ?>
                                        
                                        <select id="gst" name="gst" class="form-control">
                                            <option value=" ">--Select Gst--</option>
                                            <option value="6">6 % </option>
                                            <option value="12">12 % </option>
                                            <option value="18">18 % </option>
                                        </select>
                                    <?php } ?>  
                                    @error('gst')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            
                          </div>
                        </div>





                        <div  >
                        
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Unit:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-note'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <select class="form-control" name="size" id="size">
                                            <option value=" ">-- Select --</option>
                                            <option value="Pc" <?php if($data['0']->unit=='Pc'){ echo "selected"; }?>>Pc</option>
                                            <option value="Gm" <?php if($data['0']->unit=='Gm'){ echo "selected"; }?>>Gm</option>
                                            <option value="Kg" <?php if($data['0']->unit=='Kg'){ echo "selected"; }?>>Kg</option>
                                            <option value="Ml" <?php if($data['0']->unit=='Ml'){ echo "selected"; }?>>Ml</option>
                                            <option value="Ltr" <?php if($data['0']->unit=='Ltr'){ echo "selected"; }?>>Ltr</option>
                                            <option value="Pair" <?php if($data['0']->unit=='Pair'){ echo "selected"; }?>>Pair</option>
                                            <option value="Drozen" <?php if($data['0']->unit=='Drozen'){ echo "selected"; }?>>Drozen</option>
                                        </select>

                                    <?php } else{ ?>
                                        <select class="form-control" name="size" id="size">
                                            <option value=" ">-- Select --</option>
                                            <option value="Pc">Pc</option>
                                            <option value="Gm">Gm</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Ml">Ml</option>
                                            <option value="Ltr">Ltr</option>
                                            <option value="Pair">Pair</option>
                                            <option value="Drozen">Drozen</option>
                                        </select>
                                    <?php } ?>  

                                    @error('size')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            </div>
                             <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Stock:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->stock }}" name="stock" placeholder="Enter Size" id="stock">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="stock"  value="{{ old('stock') }}" id="stock" placeholder="Enter Stock">
                                    <?php } ?>  

                                    @error('stock')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                           
                        </div>
                        
                        
                         <div  >
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">SKU Code:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('sku_code') }}{{ $data['0']->sku_code }}" name="sku_code" placeholder="Enter Sku Code" id="sku_code">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" placeholder="Enter Sku Code"  value="{{ old('sku_code') }}" name="sku_code" id="sku_code">
                                    <?php } ?>  
                                    @error('sku_code')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                           </div>
                        </div>
                       
                       
                         <div  >
                            
                           
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Business Value:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('business_value') }}{{ $data['0']->business_value }}" name="business_value" placeholder="Enter business value" id="business_value">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="business_value"  placeholder="Enter business value" value="{{ old('business_value') }}" id="business_value">
                                    <?php } ?>  
                                    @error('business_value')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            
                        </div>
                        
                        <?php if($bussiness_setup['0']->product_commission==1){ ?>
                        <div  >
                            
                           <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Commission:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('commission') }}{{ $data['0']->commission }}" name="commission" placeholder="Enter business value" id="commission">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="commission"  placeholder="Enter commission value" value="{{ old('commission') }}" id="commission">
                                    <?php } ?>  
                                    @error('commission')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                          <div  >
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">Description:</label><br>
                                     <div class="input-group">  
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <textarea    class="form-control ckeditor"id="description" name="description" id='description' rows="10">{{ $data['0']->description }}</textarea>
                                    <?php } else{ ?>
                                        <textarea     class="form-control ckeditor"id="description" name="description" rows="10"></textarea>
                                    <?php } ?>  
                                    @error('description')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          </div></br><br>
                        <div class="mb-3"><br>
                            <button type="submit" class="btn btn-danger" style="float: right;background: green;border-color: green; position:absolute;left:50px;" >Submit</button>
                        </div></br><br>
                    </form>
                     </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script src="https://example.com/ckfinder/ckfinder.js"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#description' ),{
		    
        
        
		} )
		.catch( error => {
			console.error( error );
		} );
</script>





<script>


$(document).ready(function(){
    
    

    
    $(".discount-type").change(function(){
        
        if($(this).val()=="percent"){
            
            $("#percent-div").slideDown();
              $("#flat-div").slideUp();
            
        }else{
            
            
                $("#flat-div").slideDown();
             $("#percent-div").slideUp();
            
        }
        
        
        
    });
    
});
</script>
















    
@endsection
