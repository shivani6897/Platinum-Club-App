<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\Product\StoreRequest;
use App\Http\Requests\Customer\Product\UpdateRequest;
use App\Models\Product;
use App\Services\Utilities\ImageService;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id',auth()->id())
        ->when(request('search'),function($q) {
            $q->where('name','LIKE','%'.request('search').'%')
                ->orWhere('price','LIKE','%'.request('search').'%')
                ->orWhere('downpayment','LIKE','%'.request('search').'%');
        })->paginate('10');
        return view('customer.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, ImageService $imageService)
    {
        $array = $request->only([
            'name',
            'price',
            'downpayment',
            'description'
        ]);
        $array['user_id'] = auth()->id();
        $array['image'] = $imageService->store($request->image, '/images/products', $request->name);
        $product = Product::create($array);
        return redirect()->route('products.index')->with('success','Product Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('customer.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product, ImageService $imageService)
    {
        $array = $request->only([
            'name',
            'price',
            'downpayment',
            'description'
        ]);
        $array['user_id'] = auth()->id();
        $array['image'] = $product->image;
        if(!empty($request->image))
        {
            $imageService->destroy('/images/products',$product->image);
            $array['image'] = $imageService->store($request->image,'/images/products',$product->name);
        }

        $product->update($array);
        return redirect()->route('products.index')->with('success','Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ImageService $imageService)
    {
        $imageService->destroy('/images/products',$product->image);
        $product->delete();
        return redirect()->back()->with('success','Product Deleted');
    }

    /**
     * Return product by product id
     * @param  Request $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductById(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return Response::json(['product' => $product]);
    }
}
