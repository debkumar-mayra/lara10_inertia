<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cms extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'text_content',
    ];
    

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['title'] ?? null, function ($query, $search) {
            $query->where('title','like', "%" . trim($search) . "%");
        });
    }

    public function scopeOrdering($query, array $filters)
    {
        $query->when($filters['fieldName'] ?? null, function ($query, $search) use($filters){
            $query->orderBy($search,$filters['shortBy']);
        });
    }
    
}
