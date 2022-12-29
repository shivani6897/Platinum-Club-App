<?php

namespace App\Http\Controllers\Customer;

use App\Imports\ImportCustomer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Customer\StoreRequest;
use App\Http\Requests\Customer\Customer\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = Customer::where('user_id', auth()->id())
            ->when(request('search'), function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('company_name', 'LIKE', '%' . request('search') . '%');
            })
            ->paginate(10);
        return view('customer/customers/index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/customers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $array = $request->validated();
        $array['user_id'] = auth()->id();
        $customer = Customer::create($array);
        return redirect()->route('customers.index')->with('success', 'Customer Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer/customers/edit', compact('customer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        $customer = $customer->update($request->validated());
        return redirect()->route('customers.index')->with('success', 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $invoices = Invoice::where('customer_id', $customer->id)->get();
        if (count($invoices) > 0)
            return redirect()->route('customers.index')->with('error', 'Deletion suspended, Customer is associate with invoice.');
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer Deleted Successfully');
    }

    public function export()
    {
        $name = 'customers_' . date('Y-m-d i:h:s');
        return Excel::download(new CustomerExport, $name . '.csv');
    }

    public function importFile()
    {
        return view('customer/customers/import');
    }

    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $customers = (new ImportCustomer())->toArray(request()->file('file'))[0];

        $totalCustomer = count($customers) - 1;
        $errorArray = [];

        DB::beginTransaction();

        try {
            for ($i = 1; $i <= count($customers) - 1; $i++) {

                $customer = $customers[$i];

                $customerByEmail = Customer::where('email', $customer[2])->first();

                if ($customer[0] == null) {
                    continue;
                }


                if ($customerByEmail) {
                    $customerData = $customerByEmail;
                } else {
                    $customerData = new Customer();
                }
                $customerData->user_id = auth()->id();
                $customerData->name = $customer[0];
                $customerData->company_name = $customer[1];
                $customerData->email = $customer[2];
                $customerData->phone_no = $customer[3];
                $customerData->gst_no = $customer[4];
                $customerData->state = $customer[5];
                $customerData->company_address = $customer[6];
                $customerData->save();
            }

            DB::commit();
            $data['status'] = 'success';
            $data['msg'] = __('Record successfully imported');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            $errorRecord = [];

            $data['status'] = 'error';
            $data['msg'] = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');

            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->route('customers.index')->with($data['status'], $data['msg']);
    }
}
