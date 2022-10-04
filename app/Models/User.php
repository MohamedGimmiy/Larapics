<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function social()
    {
        return $this->hasOne(Social::class)->withDefault(); //, "id_user", "_id");
    }
    // get the latest results
/*     public function recentSocial()
    {
        return $this->hasOne(Social::class)->latestOfMany();
    }

    public function oldestSocial()
    {
        return $this->hasOne(Social::class)->oldestOfMany();
    }

    // list by priority column
    public function socialPriority()
    {
        return $this->hasOne(Social::class)->ofMany('priority','min');
    } */

    public function getImagesCount()
    {
         $imagesCount = $this->images()->published()->count();
         return $imagesCount .' '. str()->plural('image', $imagesCount);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'role' => Role::class
    ];
}
