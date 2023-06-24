<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Product([
            'name'           => $row['name'],
            'email'          => $row['email'], 
            'no_of_spins'    => $row['spins'],
            'spins_used'     => $row['used'],
            'spins_remaining'=> $row['spins']-$row['used'],
            'prize'          => $row['prize'], 
        ]);
    }
}
