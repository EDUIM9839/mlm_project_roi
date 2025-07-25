@extends('admin.layouts.main')
@section('mains')

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

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
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
    .btn-primary {
    color: #fff;
    background-color: #008cff;
    border-color: #008cff;
    width: 200;
    /* position: absolute; */
    /* bottom: 25px; */
    margin-top: 10px !important;
}
</style>

<!----------------------------------------Add pages--------------------------->

@if(empty($data['0']->id))
<!------------------------------------start page wrapper ------------------------------------------>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo $title; ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{ route('product-list') }}"
                        class='badge bg-info'>Product List</a></h6>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <div class="form-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <?php //echo session()->get('message');
                            ?>
                        </div>
                    </div>
                    <form action="{{ route('save_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h4 align='right'> <span style='font-size:18px;'>Joining Product : </span><label class="switch">
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
                                        
                                        <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}"
                                            placeholder="Enter Product Name"> 
                                    </div>
                                    @error('product_name')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                {{-- <input type="hidden" class="form-control" value="AP002" name="referal"
                                    id="referal"> --}}

                                <div class="mb-3">
                                    <label class="form-label">Select Category:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-note'></i></span>

                                        <select class="form-control" name="category_id" id="category_id" value="{{old('category_id')}}"
                                            onchange="getsubcategory(this.value);">
                                            <option value=''>--Select Category--</option>
                                            @foreach($category as $row)
                                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                                              @endforeach
                                        </select>
                                        </div>
                                        @error('category_id')
                                        <small style="color:red;font-size:15px"">{{ $message }}</small>
                                        @enderror
                                    
                                </div>
                                <div class="col-md-12">
                                    <?php if(!empty($data['0']->id)){?>
                                    <input type="hidden" class="form-control" value="{{ $data['0']->id }}" name="id"
                                        id="id">
                                    <?php } ?>

                                    <div class="mb-3">
                                        <label class="form-label">Select Sub Category:</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='bx bxs-inbox'></i></span>
                                            <?php if(!empty($data['0']->id)){?>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                <option value='{{$subcategories[0]->id}}'selected>
                                                    {{$subcategories[0]->subcategory_name}}</option>
                                                @foreach($subcategory as $s)
                                                <option value='{{$s->id}}'selected>{{$s->subcategory_name}}</option>
                                                @endforeach
                                            </select>
                                            <?php } else{ ?>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                            </select>
                                            <?php } ?>
                                            </div>
                                            @error('subcategory_id')
                                            <small style="color:red;font-size:15px">{{ $message }}</small>
                                            @enderror
                                        
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Product Image:</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='bx bxs-image'></i></span>
                                            <input type="file" accept="image/*" class="form-control" name="image">
                                            </div>
                                            @error('image')
                                            <small style="color:red;font-size:15px">{{ $message }}</small>
                                            @enderror
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">MRP (₹):</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-coin'></i></span>

                                                <input type="text" class="form-control" name="mrp" id="mrp"
                                                    value="{{ old('mrp') }}" id="mrp" placeholder="Enter MRP">
</div>
                                                @error('mrp')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
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
                                                    <input type='radio' id='percent_d' class="discount-type"
                                                        name="discount_type" value="percent"> <label
                                                        for="percent"><b>Percent</b></label>
                                                </div>
                                                <div class='col-md-2'>
                                                    <input type='radio' id='percent_f' class="discount-type"
                                                        name="discount_type" value="flat"> <label
                                                        for="flat"><b>Flat</b></label>
                                                </div>
                                                </div>
                                                @error('discount_type')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="percent-div" style='display:none;'>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Discount (%):</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-coin'></i></span>

                                                <input type="number" class="form-control" pattern="\d*" min="1" max="99"
                                                    maxlength="2"  name="percent_discount"
                                                    placeholder="Enter Discount" oninput="getdiscounttyped(this.value)"
                                                     id="discount">
                                                     </div>
                                                @error('discount')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                            <small style="color:red" id="showd"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="flat-div">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Flat Discount:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-coin'></i></span>
                                                <input type="number" class="form-control" pattern="\d*" min="1"
                                                    maxlength="2" value="" name="flat_discount"
                                                    placeholder="Enter Flat Discount" id="flat_discount"
                                                    oninput="getdiscounttypef(this.value)">
</div>
                                                @error('flat_discount')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                            <small style="color:red" id="showf"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Gst (%):</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-coin'></i></span>

                                                <?php if(!empty($data['0']->id)){?>
                                                <select id="gst" name="gst" class="form-control">
                                                    <option value=" ">--Select Gst--</option>
                                                    <option value="6" <?php if ($data['0']->gst == 6) {
                                                        echo 'selected';
                                                        } ?>>6 %
                                                    </option>
                                                    <option value="12" <?php if ($data['0']->gst == 12) {
                                                        echo 'selected';
                                                        } ?>>12 %
                                                    </option>
                                                    <option value="18" <?php if ($data['0']->gst == 18) {
                                                        echo 'selected';
                                                        } ?>>18 %
                                                    </option>
                                                </select>
                                                <?php } else{ ?>

                                                <select id="gst" name="gst" class="form-control">
                                                    <option value=" ">--Select Gst--</option>
                                                    <option value="6">6 % </option>
                                                    <option value="12">12 % </option>
                                                    <option value="18">18 % </option>
                                                </select>
                                                <?php } ?>
                                                </div>
                                                @error('gst')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Unit:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-note'></i></span>

                                                <select class="form-control" name="size" id="size">
                                                    <option value="{{old('size')}} ">-- Select --</option>
                                                    <option value="Pc">Pc</option>
                                                    <option value="Gm">Gm</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="Ml">Ml</option>
                                                    <option value="Ltr">Ltr</option>
                                                    <option value="Pair">Pair</option>
                                                    <option value="Drozen">Drozen</option>
                                                </select>
</div>
                                                @error('size')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Stock:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control"  name="stock"
                                                    placeholder="Enter Size" id="stock" value="{{old('stock')}}">
</div>
                                                @error('stock')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">HSN Code:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control" value="{{old('sku_code')}}" name="sku_code"
                                                    placeholder="Enter Sku Code" id="sku_code">
</div>
                                                @error('sku_code')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Business Value:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control" value="{{old('business_value')}}" name="business_value"
                                                    placeholder="Enter business value" id="business_value">
                                                    </div>
                                                @error('business_value')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Rating:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control" value="{{old('rating')}}" pattern="\d*" min="1" max="99" maxlength="2" name="rating"
                                                    placeholder="Enter rating" id="rating">
</div>
                                                @error('rating')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                @if($bussiness_setup['0']->product_commission==1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Commission:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control" value="{{old('commission')}}" name="commission"
                                                    placeholder="Enter business value" id="commission">
</div>
                                                @error('commission')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Description:</label>
                                        <textarea cols="80" class="form-control ckeditor" id="description"
                                            name="description" id='description' rows="10">{{{old('description')}}}</textarea>
                                            </div>
                                        @error('description')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                        @enderror
                                    
                                </div>
                            </div></br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary style=" float: right;">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@else

<!--------------------------------Edit form----------------------------------------->

<div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{ route('product-list') }}"
                            class='badge bg-info'>Product List</a></h6>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body ">
                        <div class="row">
                            <div class="col-md-12"><?php //echo session()->get('message');
                            ?></div>
                        </div>
                        <form action="{{ route('update_product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            @php
                            $d=$data['0']->first_or_repurchase;
                            @endphp
                            @if($d=='first')
                             <h4 align='right'> <span style='font-size:18px;'>Joining Product : </span><label class="switch">
                                    <input type="checkbox" name="first_or_repurchase"  checked > 
                                    <span class="slider"></span>
                                </label>
                            </h4>
                             @else
                               <h4 align='right'> <span style='font-size:18px;'>Joining Product : </span><label class="switch">
                                    <input type="checkbox" name="first_or_repurchase"> 
                                    <span class="slider"></span>
                                </label>
                            </h4>
                             @endif
                            
                            <div class="border p-4 rounded">
                                <div class="row g-6">
                                    <div class="col-md-12">
                                        <label class="form-label">Product Name:</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='bx bxs-user'></i></span>
                                            <input type="text" class="form-control"
                                                value="{{ $data['0']->product_name }}" name="product_name"
                                                placeholder="Enter Product Name">
                                            @error('product_name')
                                                <small style="color:red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                  </div>    

                                    <div class="col-md-12 mt-3">
                                        {{-- <input type="hidden" class="form-control" value="AP002" name="referal"  id="referal"> --}}
                                        
                                        <input type="hidden" class="form-control" value="{{ $data['0']->id }}"
                                            name="id" id="id">
                                        <div class="mb-3">
                                            <label class="form-label">Select Category:</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                        class='bx bxs-note'></i></span>
                                                <select class="form-control" name="category_id">
                                                    <option value='{{$data2[0]->id}}'>{{$data2[0]->category_name}}</option>
                                                     @foreach($category as $row)
                                                    <option value="{{ $row->id }}">{{$row->category_name}}</option>
                                                    @endforeach
                                                </select>
                                               
                                                @error('category_id')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" value="{{ $data['0']->id }}"
                                                name="id" id="id">
                                            <div class="mb-3">
                                                 @if(isset($subcategories[0]->id) && (!empty($subcategories[0]->id)))
                                                <label class="form-label">Select Sub Category:</label>
                                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                            class='bx bxs-inbox'></i></span>
                                                    <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                          <option value='{{$subcategories[0]->id}}'>{{$subcategories[0]->subcategory_name}}</option>
                                                          @foreach($subcategory as $s)
                                                          <option value='{{$s->id}}'>{{$s->subcategory_name}}</option>
                                                          @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                             @endif
  



                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">MRP (₹):</label>
                                                            <div class="input-group"> <span
                                                                    class="input-group-text bg-transparent"><i
                                                                        class='bx bxs-coin'></i></span>
                                                                <input type="text" class="form-control"  id="mrp" 
                                                                    value="{{ $data['0']->mrp }}" name="mrp" placeholder="Enter MRP">
                                                                @error('mrp')
                                                                    <small style="color:red">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Discount Type:</label>
                                                                <div class="row input-group">
                                                                     @php
                                                                     $dd=$data['0']->discount_type;
                                                                     @endphp
                                                                     @if($dd=='percent' || $dd=='')
                                                                    <div class='col-md-2'>
                                                                        <input type='radio' id='percent_d'
                                                                            class="discount-type" name="discount_type"
                                                                            value="percent" checked> <label
                                                                            for="percent"><b>Percent</b></label>
                                                                    </div>
                                                                    <div class='col-md-2'>
                                                                        <input type='radio' id='percent_f' 
                                                                            class="discount-type" name="discount_type"
                                                                            value="flat"> <label
                                                                            for="flat"><b>Flat</b></label>
                                                                    </div>
                                                                    @elseif($dd=='flat'|| $dd=='')
                                                                    <div class='col-md-2'>
                                                                        <input type='radio' id='percent_d'
                                                                            class="discount-type" name="discount_type"
                                                                            value="percent"> <label
                                                                            for="percent"><b>Percent</b></label>
                                                                    </div>
                                                                    <div class='col-md-2'>
                                                                        <input type='radio' id='percent_f' checked
                                                                            class="discount-type" name="discount_type"
                                                                            value="flat" checked> <label
                                                                            for="flat"><b>Flat</b></label>
                                                                    </div>
                                                                    @endif
                                                                      
                                                                    @error('discount_type')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     @php
                                                     $dd1=$data['0']->discount_type;
                                                     @endphp
                                                     @if($dd1=='percent'|| $dd1=='')
                                                    <div class="row" id="percent-div">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Discount (%):</label>
                                                                <div class="input-group"> <span
                                                                        class="input-group-text bg-transparent"><i class='bx bxs-coin'></i></span>
                                                                    <input type="number" class="form-control" pattern="\d*" min="1" max="99" maxlength="2"   
                                                                        name="percent_discount" placeholder="Enter Discount" oninput="getdiscounttyped(this.value)"  
                                                                         value="{{ $data['0']->percent_discount}}" id="discount">
                                                                    @error('discount')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                    <small style="color:red" id="showd" value="{{ $data['0']->dp}}">Old DP:{{ $data['0']->dp}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="flat-div"  style='display:none;'>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Flat Discount:</label>
                                                                <div class="input-group"> <span
                                                                        class="input-group-text bg-transparent">
                                                                    <i class='bx bxs-coin'></i></span>
                                                                    <input type="number" class="form-control" pattern="\d*" min="1"  maxlength="2"
                                                                        value="{{ $data['0']->flat_discount }}" name="flat_discount"placeholder="Enter Flat Discount"
                                                                        id="flat_discount" oninput="getdiscounttypef(this.value)">
                                                                   
                                                                    @error('flat_discount')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                    <small style="color:red" id="showf" value="{{ $data['0']->dp}}">Old Dp:{{ $data['0']->dp}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @elseif($dd1=='flat'|| $dd1=='')
                                                    <div class="row" id="flat-div">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Flat Discount:</label>
                                                                <div class="input-group"> <span
                                                                        class="input-group-text bg-transparent">
                                                                    <i class='bx bxs-coin'></i></span>
                                                                    <input type="number" class="form-control" pattern="\d*" min="1"  maxlength="2"
                                                                        value="{{ $data['0']->flat_discount }}" name="flat_discount"placeholder="Enter Flat Discount"
                                                                        id="flat_discount" oninput="getdiscounttypef(this.value)">
                                                                   
                                                                    @error('flat_discount')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                    <small style="color:red" id="showf" value="{{ $data['0']->dp}}">Old Dp:{{ $data['0']->dp}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="percent-div" style='display:none;'>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Discount (%):</label>
                                                                <div class="input-group"> <span class="input-group-text bg-transparent">
                                                                    <i class='bx bxs-coin'></i></span>
                                                                    <input type="number" class="form-control" pattern="\d*" min="1" max="99" maxlength="2"
                                                                    value="{{ $data['0']->percent_discount}}"  name="percent_discount" placeholder="Enter Discount"
                                                                    oninput="getdiscounttyped(this.value)" id="discount">
                                                                   
                                                                    @error('discount')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                    <small style="color:red" id="showd" value="{{ $data['0']->dp}}">Old Dp:{{ $data['0']->dp}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Gst (%):</label>
                                                                <div class="input-group"> <span
                                                                        class="input-group-text bg-transparent"><i
                                                                            class='bx bxs-coin'></i></span>
                                                                    <select id="gst" name="gst"
                                                                        class="form-control">
                                                                        <option value=" ">--Select Gst--</option>
                                                                        <option value="6" <?php if ($data['0']->gst == 6) {
                                                                            echo 'selected';
                                                                        } ?>>6 %
                                                                        </option>
                                                                        <option value="12" <?php if ($data['0']->gst == 12) {
                                                                            echo 'selected';
                                                                        } ?>>12 %
                                                                        </option>
                                                                        <option value="18" <?php if ($data['0']->gst == 18) {
                                                                            echo 'selected';
                                                                        } ?>>18 %
                                                                        </option>
                                                                    </select>
                                                                   
                                                                    @error('gst')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
 
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Unit:</label>
                                                                <div class="input-group"> <span
                                                                        class="input-group-text bg-transparent"><i
                                                                            class='bx bxs-note'></i></span>
                                                                    <select class="form-control" name="size"
                                                                        id="size">
                                                                        <option value=" ">-- Select --</option>
                                                                        <option value="Pc" <?php if ($data1['0']->size == 'Pc') { echo 'selected';} ?> >Pc  
                                                                        </option>
                                                                        <option value="Gm" <?php if ($data1['0']->size == 'Gm') { echo 'selected';} ?> >Gm
                                                                        </option>
                                                                        <option value="Kg" <?php if ($data1['0']->size == 'Kg') { echo 'selected';} ?>  >Kg  
                                                                        </option>
                                                                        <option value="Ml" <?php if ($data1['0']->size == 'Ml') { echo 'selected';} ?>>Ml
                                                                        </option>
                                                                        <option value="Ltr" <?php if ($data1['0']->size == 'Ltr') { echo 'selected';} ?>>Ltr
                                                                        </option>
                                                                        <option value="Pair" <?php if ($data1['0']->size == 'Pair') { echo 'selected';} ?>>Pair
                                                                        </option>
                                                                        <option value="Drozen"<?php if ($data1['0']->size == 'Drozen') { echo 'selected';} ?>>Drozen
                                                                        </option>
                                                                    </select>
                                                                    @error('size')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Stock:</label>
                                                                <div class="input-group"> <span class="input-group-text bg-transparent">
                                                                    <i class='bx bxs-inbox'></i></span>
                                                                    <input type="text" class="form-control" value="{{$data1['0']->stock}}" name="stock"
                                                                        placeholder="Enter Size" id="stock">
                                                                    @error('stock')
                                                                        <small style="color:red">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">HSN Code:</label>
                                                                    <div class="input-group"> <span
                                                                            class="input-group-text bg-transparent"><i
                                                                                class='bx bxs-inbox'></i></span>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ old('sku_code') }}{{ $data['0']->sku_code }}"
                                                                            name="sku_code" placeholder="Enter Sku Code"
                                                                            id="sku_code">
                                                                       
                                                                        @error('sku_code')
                                                                            <small
                                                                                style="color:red">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Business Value:</label>
                                                                    <div class="input-group"> <span
                                                                            class="input-group-text bg-transparent"><i
                                                                                class='bx bxs-inbox'></i></span>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ old('business_value') }}{{ $data['0']->business_value }}"
                                                                            name="business_value"
                                                                            placeholder="Enter business value"
                                                                            id="business_value">
                                                                        @error('business_value')
                                                                            <small
                                                                                style="color:red">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php if($bussiness_setup['0']->product_commission==1){ ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Commission:</label>
                                                                    <div class="input-group"> <span
                                                                            class="input-group-text bg-transparent"><i
                                                                                class='bx bxs-inbox'></i></span>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ old('commission') }}{{ $data['0']->commission }}"
                                                                            name="commission"
                                                                            placeholder="Enter business value"
                                                                            id="commission">
                                                                        @error('commission')
                                                                            <small
                                                                                style="color:red">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        
                                                         <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Rating:</label>
                                                                    <div class="input-group"> <span
                                                                            class="input-group-text bg-transparent"><i
                                                                                class='bx bxs-inbox'></i></span>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ old('rating') }}{{ $data['0']->rating }}"
                                                                            name="rating" placeholder="Enter rating "
                                                                            id="rating">
                                                                       
                                                                        @error('rating')
                                                                            <small
                                                                                style="color:red">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                          <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Description:</label>
                                                                <textarea cols="80" class="form-control ckeditor" id="description"
                                                                    name="description" id='description' rows="10">{{ $data['0']->description }}</textarea>
                                                                @error('description')
                                                                <small style="color:red">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div><br><br>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary
                                                                style="float: right;">Submit</button> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
          </div>
    </div>

@endif







<!---------------------scripts------------------------------------>

<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script src="https://example.com/ckfinder/ckfinder.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    function getdiscounttyped(value) {
        let mrp = $("#mrp").val();
        let discount = $("#discount").val();
        if (discount <= 100) {
            let cal = mrp * discount / 100;
            let cald = mrp - cal;
            $("#showd").html("DP " + "{{Helper::get_currency()}} " + cald);
        }
    }

    function getdiscounttypef(value) {
        let mrp = $("#mrp").val();
        let flat_discount = $("#flat_discount").val();
        if (!(mrp == '')) {
            let calf = mrp - flat_discount;
            if (calf <= 0) {
                $("#showf").html("DP " + "{{Helper::get_currency()}} " + "0");
            } else {
                $("#showf").html("DP " + "{{Helper::get_currency()}} " + calf);
            }
        }

        if (parseInt(mrp) < parseInt(flat_discount)) {
            let tmrp = mrp - 1;
            $("#flat_discount").val(tmrp);
        }
    }

    $(document).ready(function () {
        $(".discount-type").change(function () {
            if ($(this).val() == "percent") {
                $("#percent-div").slideDown();
                $("#flat-div").slideUp();
                $("#flat_discount").val(1);
            } else {
                $("#flat-div").slideDown();
                $("#percent-div").slideUp();
                $("#discount").val(1);
            }
        });

    });

</script>

@endsection