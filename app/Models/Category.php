<?php

namespace App\Models;

use App\helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public static function CreateOrUpdate($request, $id = null)
    {
        Category::updateorcreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'image' => Helper::uploadFile($request->newPhoto, 'category', 200, 200, isset($id) ? Category::find($id)->image : null),
            ]
        );
    }
}
