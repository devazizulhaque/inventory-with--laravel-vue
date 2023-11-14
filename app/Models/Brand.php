<?php

namespace App\Models;

use App\helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
    ];

    public static function CreateOrUpdate($request, $id = null)
    {
        Brand::updateorcreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'photo' => Helper::uploadFile($request->newPhoto, 'brand', 200, 200, isset($id) ? Brand::find($id)->photo : null),
            ]
            );
    }
}
