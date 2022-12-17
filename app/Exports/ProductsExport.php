<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromView, WithStyles
{
    public function view(): View
    {
        $products = Product::get();
        return view('export.products', compact('products'));
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [ 'bold' => true, 'size' => 17 ]
            ]
        ];
    }
}
