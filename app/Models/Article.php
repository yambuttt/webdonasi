<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Support\Str;

#[Fillable(['user_id', 'title', 'slug', 'thumbnail', 'content', 'status'])]
class Article extends Model
{
    use HasFactory;

    /**
     * Get the user (author) that wrote the article.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accessor: Clean excerpt from HTML content.
     */
    public function getExcerptAttribute()
    {
        // Strip HTML tags from Quill editor
        $cleanContent = strip_tags($this->content);
        return Str::limit($cleanContent, 120, '...');
    }
}
