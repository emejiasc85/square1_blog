<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* mutators */

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('title', 'LIKE', '%'.request()->search.'%');
        });
    }
    
    public function scopeOrder($query)
    {
        return $query->when(request()->filled('order_col') && request()->filled('order'), function($query){
            $query->orderBy(request()->order_col, request()->order);
        });
    }
}
