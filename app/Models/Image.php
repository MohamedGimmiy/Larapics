<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['title','file','dimension','user_id', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }
    public static function makeDirectory()
    {
        # code...
        $subfolder = 'images/'.date('Y/m/d');
        Storage::makeDirectory($subfolder);
        return $subfolder;
    }

    public static function getDimension($image)
    {
        # code...
        [$width, $height] = getimagesize(Storage::path($image));
        return $width . 'x'. $height;
    }

    public function scopePublished($query)
    {
        # code...
        return $query->where('is_published', true);
    }
    public function scopeVisibleFor($query, User $user)
    {
        if($user->role === Role::Admin || $user->role === Role::Editor)
            return;
        return $query->where("user_id", $user->id);
    }

    // return actual url of an image
    public function fileUrl()
    {
        return Storage::url($this->file);
    }

    public function permalink()
    {
        return $this->slug? route('images.show', $this->slug): '#';
    }

    public function route($method, $key = 'id')
    {
        return route("images.{$method}", $this->$key);
    }

    public  function getSlug()
    {
        # code...
        $slug = str($this->title)->slug();
        $numSlugFound = static::where('slug', 'regexp', "^". $slug. "(-[0-9])?")->count();
        if($numSlugFound > 0){
            return $slug . "-". $numSlugFound + 1;
        }
        return $slug;
    }

    protected static function booted()
    {   // elqoent events in laravel php
        static::creating(function ($image){
            if($image->title){
                $image->slug = $image->getSlug();
                $image->is_published = true;

            }
        });

        static::updating(function ($image){
            if($image->title && !$image->slug){
                $image->slug = $image->getSlug();
                $image->is_published = true;
            }
        });
        // removing file after deleting
        static::deleted(function ($image){
            Storage::delete($image->file);
        });
    }

}
