<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use Hash;


class ProductController extends Controller
{
      public function products()
      {
         
       $product = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.pid')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            ->select('products.*', 'product_images.image','product_stocks.size','product_stocks.stock')
            ->where('products.first_or_repurchase','=','repurchase')->groupBy('products.id')
            ->get();
         
        return view('user.products',compact('product'));
    }
      public function product_details($id)
      {
       $product = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.pid')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            ->select('products.*', 'product_images.image','product_stocks.size','product_stocks.stock')
            ->where('products.id',$id)->where('products.first_or_repurchase','=','repurchase')
            ->get();
            
       $lastproduct = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.pid')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            ->select('products.*', 'product_images.image','product_stocks.size','product_stocks.stock')
            ->where('products.first_or_repurchase','=','repurchase')->where('products.id','<>',$id)
            ->orderBy('id', 'desc')->groupby('products.id')->take(3)->get();
        return view('user.Product_details',compact('product','lastproduct','id'));
    }
    
        public function welcomepage(Request $request)
        {
        $product = DB::table('products')
            // ->join('product_images', 'products.id', '=', 'product_images.pid')
            // ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            // ->select('products.*', 'product_images.image','product_images.id as img_id','product_stocks.size','product_stocks.stock')
            ->where('products.first_or_repurchase','=','first')
            ->get();
        return view('user.welcome',compact('product'));
    }
    public function GeneratesInvoice(Request $request){
        $id=Auth::user()->id;
        $OrderId=$request->id;
        $data=DB::table('business_setup')->where('id' , $id)->get();
        $r_orders=DB::table('r_orders')->where('id' , $OrderId)->get();
        return view('user.GeneratesInvoice', compact('data', 'r_orders'));
    }

      public function first_product_details($id)
      {
          
       
            $product = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.pid')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            ->select('products.*', 'product_images.image','product_stocks.size','product_stocks.stock')
            ->where('products.id',$id)->where('products.first_or_repurchase','=','first')
            ->get();
            
            
       $lastproduct = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.pid')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.pid')
            ->select('products.*', 'product_images.image','product_stocks.size','product_stocks.stock')
            ->where('products.first_or_repurchase','=','first')->where('products.id','<>',$id)
            ->orderBy('id', 'desc')->groupby('products.id')->take(3)->get();
        return view('user.first_product_details',compact('product','lastproduct','id'));
    }
     
     
}




