<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\helper\Helper;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'salary',
        'phone',
        'address',
        'position',
        'role_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function createOrUpdate($validatedData)
    {
        $user = User::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                'name' => $validatedData['name'],
                'password' => Hash::make($validatedData['password']),
                'role_type' => 1,
            ]
        );

        return $user;
    }

    public static function employeeCreateOrUpdate($request, $id = null)
    {
        $user = User::updateorcreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_type' => 2,
                'phone' => $request->phone,
                'address' => $request->address,
                'position' => $request->position,
                'salary' => $request->salary,
                'photo' => Helper::uploadFile($request->newPhoto, 'employee', 240, 200, isset($id) ? User::find($id)->photo : null),
            ]
        );

        return $user;
    }
}
