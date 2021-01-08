<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function poll()
    {
        return $this->belongsToMany(Poll::class);
    }

    /**
     * @OA\Schema(
     *      schema="LoginRequest",
     *      title="Login Request",
     *      description="Email and passwords are required for login",
     *      type="object",
     *      required={"email", "password"},
     *      @OA\Property(
     *          property="email",
     *          description="Email",
     *          format="string",
     *          example="test"
     *      ),
     *      @OA\Property(
     *          property="password",
     *          description="Password",
     *          format="password",
     *          example="*****"
     *      )
     * )
     */

    /**
     * @OA\Schema(
     *      schema="RegistrationModel",
     *      title="User Registration Model",
     *      description="User Registration Model",
     *      type="object",
     *      required={"name", "email", "password", "password_confirmation"},
     *      @OA\Property(
     *          property="name",
     *          description="Name",
     *          format="string",
     *          example="Pratik"
     *      ),
     *      @OA\Property(
     *          property="email",
     *          description="Email",
     *          format="string",
     *          example="pratik.darji@rishabhsoft.com"
     *      ),
     *      @OA\Property(
     *          property="password",
     *          description="Password",
     *          format="password",
     *          example="Asdf@123"
     *      ),
     *      @OA\Property(
     *          property="password_confirmation",
     *          description="Password Confirm",
     *          format="password",
     *          example="Asdf@123"
     *      )
     * )
     */
}
