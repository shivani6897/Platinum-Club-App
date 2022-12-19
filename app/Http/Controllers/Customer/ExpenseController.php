<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Expense\StoreRequest;
use App\Http\Requests\Customer\Expense\UpdateRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expense = Expense::with('incomeCategory')->where('user_id',auth()->id())
        ->when(request('search'),function($q){
            $q->where('income','LIKE', '%'.request('search').'%');
        })
            ->paginate(10);
        return view('customer.incomes.index', compact('expense'));
    }

    public function create()
    {
        $expenseCateogries = ExpenseCategory::all(['id','name']);
        $incomeCateogries = IncomeCategory::all(['id','name']);

        return view('customer.incomes.create',compact('expenseCateogries','incomeCateogries'));
    }

    public function store(StoreRequest $request)
    {
        $array = $request->validated();
        $array['user_id'] = auth()->id();
        $expense = Expense::create($array);

        return redirect()->route('incomes.index')->with('success','Expense Created successfully');
    }

    public function edit(Expense $expense)
    {
        $expenseCateogries = ExpenseCategory::all(['id','name']);
        $incomeCateogries = IncomeCategory::all(['id','name']);

        return view('customer.incomes.expense_edit',compact('expenseCateogries','incomeCateogries', 'expense'));
    }

    public function update(UpdateRequest $request,Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()->route('incomes.index')->with('success','Expense Updated Successfully');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('incomes.index')->with('success','Expense Deleted Successfully');
    }
}
