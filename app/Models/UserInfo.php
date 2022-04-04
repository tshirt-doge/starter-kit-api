<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

/**
 * @mixin IdeHelperUserInfo
 */
class UserInfo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'mobile_number',
        'sex',
        'birthday',
        'home_address',
        'barangay',
        'city',
        'region',
        'profile_picture_url',
        'meta'
    ];

    /**
     * The attributes that should be hidden.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
        'sex' => SexEnum::class, // Laravel 9 enum casting. @see https://laravel.com/docs/9.x/releases
    ];

    /**
     * Dynamic computed attributes
     *
     * @var array<int, string>
     */
    protected $appends = [
        'full_name'
    ];


    /**
     * UserInfo belongs to a User
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Append full_name attribute. This is a Laravel 9 syntax
     *
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return new Attribute(function () {
            $firstName = $this->first_name;
            $lastName = $this->last_name;
            $middle_name = $this->middle_name;

            if ($middle_name) {
                return "$firstName $middle_name $lastName";
            }

            return "$firstName $lastName";
        });
    }
}
