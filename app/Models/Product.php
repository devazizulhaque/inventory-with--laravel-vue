<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'brand_id',
        'category_id',
        'unit_id',
        'name',
        'sku',
        'barcode',
        'alert_quantity',
        'sale',
        'status',
        'stock',
        'price',
        'description',
        'photo',
    ];

    public static function CreateOrUpdate($request, $id = null)
    {
        Product::updateorcreate(
            ['id' => $id],
            [
                'user_id' => auth()->user()->id,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'name' => $request->name,
                'sku' => $request->sku,
                'barcode' => $request->barcode,
                'alert_quantity' => $request->alert_quantity,
                'status' => $request->status,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $request->newPhoto,
            ]
            );
    }
}
