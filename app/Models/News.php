<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_category_id', 'users_id', 'title', 'slug', 'content', 'created_by', 'updated_by'
    ];

    public function newsImage() {
        return $this->belongsTo(NewsImage::class, 'id', 'news_id');
    }

    public function newsComment() {
        return $this->hasMany(NewsComments::class, 'news_id', 'id');
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value);
    }
}
