<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Customer::where('user_id',auth()->id())->get();
        foreach($data as $k=>$customer )
        {
            $data[$k]["created_by"]=$customer->user?->first_name . " " . $customer->user?->last_name;
            unset($customer->id,$customer->user_id,$customer->created_at,$customer->updated_at,$customer->deleted_at);
        }
        return $data;
    }
    public function headings(): array
    {
        return [
            "Name",
            "Company Name",
            "Email ID",
            "Phone Number",
            "GST Number",
            "State",
            "Company Address",
            "Created By"
        ];
    }
}
