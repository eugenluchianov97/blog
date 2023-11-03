<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = false;


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');

    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function setSlug($value) {
        $collection = static::whereSlug($slug = Str::slug($value));
        $count = static::where('name','LIKE',$value)->count();

        if ($collection->exists()) {

            $slug = $slug . '-'.$count+1;
        }

        return $slug;
    }

    public function products()
    {

        return $this->belongsToMany(Product::class, 'category_products');

    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'categories_posts');
    }



}
