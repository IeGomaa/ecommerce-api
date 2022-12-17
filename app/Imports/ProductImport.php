<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row): Product
    {
        return new Product([
            'name' => $row['name'],
            'price' => $row['price'],
            'stock' => $row['stock'],
            'category_id' => $row['category_id']
        ]);
    }

    public function rules(): array
    {
        return Product::rule();
    }
}
