<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class LandingPageController extends Controller
{
    public function index($id)
    {
        $products = Product::where('user_id',$id)->get();
        $selectedProduct = Product::where('user_id',$id)->firstOrNew();
        return view('customer.landing.index',compact('products','id','selectedProduct'));
    }

    public function getProduct($id,Product $product)
    {
        $json = [
            'id'=>$product->id,
            'name'=>$product->name,
            'image'=>$product->image,
            'description'=>$product->description,
            'downpayment'=>$product->downpayment
        ];

        return response()->json(['status'=>1,'message'=>'Data retrived','data'=>$json]);
    }
}
