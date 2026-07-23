<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Sortable;

class GalleryImage extends Model
{
    use Sortable;

    protected $fillable = [
        'gallery_id',
        'image_url',
        'caption',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
