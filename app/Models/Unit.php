<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'short_name',
    ];

    public static function CreateOrUpdate($request, $id = null)
    {
        Unit::updateorcreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'short_name' => $request->short_name,
            ]
            );
    }
}
