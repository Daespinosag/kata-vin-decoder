<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $phone
 * @property mixed $phone_code
 * @property mixed $full_phone_number
 * @property mixed $password
 * @property mixed $id
 * @property mixed $phone_verified_at
 * @property mixed $code_verification
 */
class User extends Authenticatable
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
        'phone',
        'phone_code',
        'code_verification',
        'password',
        'phone_verified_at'
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
        'password'          => 'hashed',
        'phone_verified_at' => 'datetime'
    ];

    public function getFullPhoneNumberAttribute(): int
    {
        $phoneCode = str_replace('+', '', $this->phone_code);
        $fullPhoneNumber = $phoneCode . $this->phone;

        return (int) $fullPhoneNumber;
    }
}
