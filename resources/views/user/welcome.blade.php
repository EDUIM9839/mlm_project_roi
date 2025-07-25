<!DOCTYPE html>
<html>
<head>
    
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel='stylesheet'>
	
	
<style>

    
    @import url('https://fonts.googleapis.com/css?family=IBM%20Plex%20Sans:600|IBM%20Plex%20Sans:400');

* {
  box-sizing: border-box;
}

body {
  font-family: 'IBM Plex Sans';
  font-weight: 400;
 
      
}

h2 {
  font-family: 'IBM Plex Sans';
  font-weight: 600;
  margin: 0;
}

h3 {
  font-family: 'IBM Plex Sans';
  font-weight: 400;
  margin: 0;
}

html {font-size: 100%;} /* 16px */

h2 {font-size: 1.602rem; /* 25.6px */}

h3 {font-size: 1.424rem; /* 22.72px */}

body {
  background-color: #0b0b0b;
  color: #e5e5e5;
  display: flex;
  flex-direction: column;
  height: 100vh;
  justify-content: center;
  align-items: center;
}

 

.card > div {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap:0.5rem;
  padding: 0.8rem 2rem;
  width: 100%;
}

a {
  text-decoration: none;
  color: inherit;
  padding: 0.8rem 1rem;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0.6rem;
  cursor: pointer;
  transition: all ease 0.3s;
}

#link1 {
  background-color: white;
  color: black;
}

#link2 {
  background-color: #cf503a;
}

#link1:hover, #link2:hover {
  background-color: #3a3ccf;
  color: white;
}

.card::before {
    
    
    content: '';
    background-color: rgb(40 39 1 / 10%);
    position: absolute;
    height: 100%;
    width: 100%;
    backdrop-filter: blur(50px);
    clip-path: polygon(evenodd, 
    0 0, 
    100% 0, 
    100% 100%, 
    0 100%, 
    0 0, 0.3rem 0.3rem, calc(100% - 0.3rem) 0.3rem, calc(100% - 0.3rem) calc(100% - 0.3rem), 0.3rem calc(100% - 0.3rem), 0.3rem 0.3rem);
}

  @media only screen and (max-width: 600px) {
            .card {
              width:95% !important;  
            }
            
            #crypto_type{
                
                font-size:14px;
            }
        }
 
  
 
 
.blocks_container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}

.blocks {
  background-color: #000;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: flex-start;
  align-items: flex-end;
  flex-wrap: wrap;
  overflow: hidden;
  z-index: 1000;
}

.block {
  width: 40px;
  height: 40px;
  border: 1px solid rgba(255, 255, 255, 0.075);
  transition: border-color 0.2s ease;
}

.impact {
  border-color: #ff00ff;
}
 
 
</style>



</head>
<body>
    <div class="blocks_container">
  <div class="blocks"></div>
</div>
 
    
@if(empty($user_package))
    
        @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" style='padding:0.8rem 1rem;'  data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('error'))

                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close"  style='padding:0.8rem 1rem;' data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif
                                
                                
                               @if($errors->any())

                                 <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2 m-3">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!$errors->all()[0]!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" style='padding:0.8rem 1rem;'  data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                               
                                
                               
                               @endif
    
                               
<div class="card">
    
    
                            
                               
                                 
                               
    
  <div>
      <center style='background:white; padding:10px; border-radius:30px;'>  <img src="/storage/app/logo/{{$business_setup->logo}}" style="width:120px"> </center>
  <h2>Welcome to {{$business_setup->business_name}}</h2>
  <h3>Joining Package : {{Helper::get_currency()}}<b>{{$package->cost}}</b></h3>
  
  
  <select class='form-control' id="payment_type">
      <option value='' disabled selected> ---select--- </option>
      <option value='wallet'>Pay by fund wallet</option>
      <option value='direct'>Pay Directly</option>
  </select>
  
  <select class='form-control' name="package">
      <option value='' disabled selected> ---select--- </option>
      @foreach($packages as $package)
      <option value='wallet'>{{$package->cost}}</option>
      @endforeach
      <option value='direct'>Pay Directly</option>
  </select>
  
  <div id='payment_type_response_div' class='d-flex justify-content-center align-items-center flex-column'>
      
  </div>
 
 
  <a class='btn btn-secondary' href='{{route("add_fund")}}'>Skip</a>
   
    </div>
  <div>
 
  
 
 
 
 
 
     	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
 
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
 
 <script>
     
     
     $('#payment_type').change(function(){
         
         if($(this).val()=='wallet'){
             $('#payment_type_response_div').html('<h4> Fund Wallet : {{Helper::get_currency()}}<b>{{Auth::user()->saving_wallet}} </h4><form  enctype="multipart/form-data"  method="post" action="{{route("join_request")}}"  class="d-flex justify-content-center" >@csrf <input name="payment_type" value="wallet" hidden /> <button class="my-2 btn btn-primary">  Join Now</button></form>');
        }else{
            
             $('#payment_type_response_div').html('<label class="form-label text-dark text-center"><b id="crypto_type"> {{$crypto_type->address}}</b></label><img style="width:30%;" src="{{asset("upibarcode/".$crypto_type->image)}}"><form  enctype="multipart/form-data"  method="post" action="{{route("join_request")}}"  class="d-flex justify-content-center flex-column align-items-center" >@csrf <label class="my-3 form-label text-dark text-center">Upload Proof of Payment</label>  <input name="payment_type" value="direct" hidden /> <input required name="proof" id="proof" type="file" class="form-control"/> <button class="my-2 btn btn-primary" style="width:50%;"> Join Now</button></form>');
        }
         
         
         
     })
     
     
 </script>
 
 
@else 
 
 
 <div style='width:100%; height:100%;'  class="d-flex justify-content-center align-items-center flex-column" >
     
     <i class="fa-regular fa-clock fa-spin-pulse" style='font-size:5rem;'></i>
   
     <h1 style="color:white;   z-index:1;">  Your Activation is Pending.</h1>
     <p style="color:white;   z-index:1;" >Contact To Admin</p>
     
    <a href='{{route("logout")}}'> <button style="background:white;   z-index:1; " class='btn btn-default'>Logout</button> </a>
     
 </div>
 
  
 
 @endif
 <script>
     
     
     //Inspired by https://www.neoculturalcouture.com

window.addEventListener("DOMContentLoaded", () => {
  const blockContainer = document.querySelector(".blocks"); // Utilisation de querySelector pour sélectionner un élément spécifique par sa classe
  const size = 40;
  const width = window.innerWidth;
  const height = window.innerHeight;
  const cols = Math.ceil(width / size);
  const rows = Math.ceil(height / size);
  const numBlocks = cols * rows;
  
  function createBlocks() {
    for (let i = 0; i < numBlocks; i++) {
      const block = document.createElement("div");
      block.classList.add("block");
      block.dataset.index = i;
      block.addEventListener("mousemove", impactNeighbors);
      blockContainer.appendChild(block); // Ajout du bloc à blockContainer
    }
  }
  
  function impactNeighbors() {
    const index = parseInt(this.dataset.index);
    const neighbors = [
      index - 1,
      index + 1,
      index - cols,
      index + cols,
      index - cols - 1,
      index - cols + 1, 
      index + cols - 1,
      index + cols + 1,
    ].filter((i) => i >= 0 && i < numBlocks && Math.abs((i % cols) - (index % cols)) <= 1);
    
    this.classList.add("impact");
    setTimeout(() => {
      this.classList.remove("impact");
    }, 500);
    
    shuffleArray(neighbors).slice(0, 1).forEach((nIndex) => {
      const neighbor = blockContainer.children[nIndex]; // Utilisation de blockContainer[nIndex]
      if (neighbor) { 
        neighbor.classList.add("impact");
        setTimeout(() => {
          neighbor.classList.remove("impact");
        }, 500);
      }       
    });
  }
  
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]]; // Correction de l'échange d'éléments du tableau
    }
    return array;
  }
  
  createBlocks();
});

 </script>

</body>
</html>