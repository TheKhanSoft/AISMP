<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\HasSlug;
use App\Traits\Publishable;

class Download extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'file_path',
        'file_size',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function formattedFileSize(): Attribute
    {
        return Attribute::make(
            get: function () {
                $bytes = $this->file_size;
                if (!$bytes) return '0 B';
                $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                $bytes = max($bytes, 0);
                $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                $pow = min($pow, count($units) - 1);
                $bytes /= pow(1024, $pow);
                return round($bytes, 2) . ' ' . $units[$pow];
            },
        );
    }
}
