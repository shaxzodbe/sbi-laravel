<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        $products = collect();

        Product::query()->with('category')->chunk(100, function ($chunk) use ($products) {
            $chunk->each(function ($product) use ($products) {
                $products->push([
                    'Название товара' => $product->name,
                    'Штрихкод' => $product->barcode,
                    'Цена' => $product->price,
                    'Категория' => optional($product->category)->name,
                ]);
            });
        });

        return $products;
    }

    public function headings(): array
    {
        return ['Название товара', 'Штрихкод', 'Цена', 'Категория'];
    }
}
