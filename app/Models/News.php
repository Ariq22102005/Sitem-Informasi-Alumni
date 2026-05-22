<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';
    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'author',
        'excerpt',
        'featured_image',
        'published_at',
        'status',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk berita yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->orderBy('published_at', 'desc');
    }

    // Scope untuk draft
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft')
                     ->orderBy('created_at', 'desc');
    }

    // Scope untuk kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Route binding by slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }

    // Generate slug otomatis
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}