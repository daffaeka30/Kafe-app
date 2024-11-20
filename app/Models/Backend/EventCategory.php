<?php

namespace App\Models\Backend;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'slug',
    ];

    public static function booted() 
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->slug = Str::slug($model->name);
        });
    }

    // relasi one to many
    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }

}
