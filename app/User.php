<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'photo'
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

    protected $appends = ['photo_url'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->categories()->create([
                'name' => 'Others',
                'slug' => 'others'
            ]);
        });
    }

    public function getPhotoUrlAttribute()
    {
        return Storage::exists($this->photo) ? url(Storage::url($this->photo)) : url($this->photo);
    }
}
