<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getUrlAttribute()
    {
        return route('show_post', [$this->id, $this->slug]);
    }
    
    public function getPublicationDateFormatedAttribute()
    {
        return Carbon::parse($this->publication_date)->format('F d\\, Y');
    }

    /* relations */

    public function user()
    {
        return $this->belongsTo(User::class);
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
