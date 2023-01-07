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
//        dd($request->all());
//        $created_at = explode('-', request('created_at'));

        $date = explode('to', request('date'));
        $start_date = $date[0];
        $end_date = $date[1];

        $array = $request->only([
            'code',
            'value',
            'is_flat',
            'active',
        ]);

        $promocode = PromoCode::create([
            'code' => $request->code,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'value' => $request->value,
            'is_flat' => $request->is_flat ? 1 : 0,
            'active' => $request->active ? 1 : 0,
        ]);

        return redirect()->route('promocodes.index')->with('success','Promocode Created successfully');
    }

    public function edit(PromoCode $promocode)
    {
        return view('customer.promocodes.edit',compact('promocode'));
    }

    public function update(UpdateRequest $request,PromoCode $promocode)
    {
        $date = explode('to', request('date'));
        $start_date = $date[0];
        $end_date = $date[1];

        $array = $request->only([
            'code',
            'value',
            'is_flat',
            'active',
        ]);
        $promocode->update([
            'code' => $request->code,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'value' => $request->value,
            'is_flat' => $request->is_flat ? 1 : 0,
            'active' => $request->active ? 1 : 0,
        ]);

        return redirect()->route('promocodes.index')->with('success','Promocode Updated Successfully');
    }

    public function destroy(PromoCode $promocode)
    {
        $promocode->delete();
        return redirect()->route('promocodes.index')->with('success','Promocode Deleted Successfully');
    }
}
