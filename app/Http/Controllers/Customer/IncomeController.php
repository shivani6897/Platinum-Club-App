<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Income\StoreRequest;
use App\Http\Requests\Customer\Income\UpdateRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Lead;
use Illuminate\Http\Request;

class IncomeController extends Controller{
    public function index(Request $request)
    {
        $income = Income::with('incomeCategory')
            ->when(request('search'),function($q){
                $q->where('income','LIKE', '%'.request('search').'%');
            })
            ->paginate(10);

        $expense = Expense::with('expenseCategory')->when(request('search'),function($q){
                $q->where('expense','LIKE', '%'.request('search').'%');
            })->paginate(10);

        $lead = Lead::when(request('search'),function($q){
            $q->where('lead_generated','LIKE', '%'.request('search').'%')
                ->orWhere('converted_customer','LIKE','%'.request('search').'%')
                ->orWhere('date','LIKE','%'.request('search').'%');
            })
            ->paginate(10);
        return view('customer.incomes.index', compact('income','expense','lead'));
    }

    public function create()
    {
        $incomeCateogries = IncomeCategory::all(['id','name']);
        $expenseCateogries = ExpenseCategory::all(['id','name']);

        return view('customer.incomes.create',compact('incomeCateogries','expenseCateogries'));
    }

    public function store(StoreRequest $request)
    {
        $array = $request->validated();
        $array['user_id'] = auth()->id();
        $income = Income::create($array);

        return redirect()->route('incomes.index')->with('success','Income Created successfully');
    }

    public function edit(Income $income)
    {
        $incomeCateogries = IncomeCategory::all(['id','name']);
        $expenseCateogries = ExpenseCategory::all(['id','name']);

        return view('customer.incomes.income_edit',compact('incomeCateogries','expenseCateogries','income', ));
    }

    public function update(UpdateRequest $request,Income $income)
    {
        $income->update($request->validated());

        return redirect()->route('incomes.index')->with('success','Income Updated Successfully');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')->with('success','Income Deleted Successfully');
    }
}
