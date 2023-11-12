<?php

namespace App\Models;

use App\helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'shopname',
        'photo',
        'due',
    ];

    public static function CreateOrUpdate($request, $id = null)
    {
        Supplier::updateorcreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'photo' => Helper::uploadFile($request->newPhoto, 'supplier', 200, 200, isset($id) ? Supplier::find($id)->photo : null),
            ]
        );
    }
}
