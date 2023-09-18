<?php

namespace App\Models;

use App\Models\Wave;
use App\Models\Djamo;
use App\Models\Orange;
use App\Models\Category;
use App\Models\FlashSale;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name','manager_name', 'email', 'password','phone','adress','location','category', 'description' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get all of the categories for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    /**
     * Get the waves associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function waves(): HasOne
    {
        return $this->hasOne(Wave::class, 'user_id', 'id');
    }

    /**
     * Get the oranges associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function oranges(): HasOne
    {
        return $this->hasOne(Orange::class, 'user_id', 'id');
    }

    /**
     * Get the djamo associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function djamos(): HasOne
    {
        return $this->hasOne(Djamo::class, 'user_id', 'id');
    }

     /**
     * Get all of the flash_sales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flash_sales(): HasMany
    {
        return $this->hasMany(FlashSale::class, 'user_id', 'id');
    }
}