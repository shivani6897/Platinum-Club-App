<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
class ImportCustomer implements ToModel
{
    use Importable;
    public function model(array $row)
    {
    }
}
