<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\PromoCode\StoreRequest;
use App\Http\Requests\Customer\PromoCode\UpdateRequest;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function index(Request $request)
    {
        $promocode = PromoCode::when(request('search'),function($q){
                $q->where('code','LIKE', '%'.request('search').'%');
            })
            ->paginate(10);

        return view('customer.promocodes.index', compact('promocode'));
    }

    public function create()
    {
        return view('customer.promocodes.create');
    }

    public function store(StoreRequest $request)
    {
        $array = $request->validated();
        $promocode = PromoCode::create($array);

        return redirect()->route('promocodes.index')->with('success','Promocode Created successfully');
    }

    public function edit(PromoCode $promocode)
    {
        return view('customer.promocodes.edit',compact('promocode'));
    }

    public function update(UpdateRequest $request,PromoCode $promocode)
    {
        $promocode->update($request->validated());
        return redirect()->route('promocodes.index')->with('success','Promocode Updated Successfully');
    }

    public function destroy(PromoCode $promocode)
    {
        $promocode->delete();
        return redirect()->route('promocodes.index')->with('success','Promocode Deleted Successfully');
    }
}
