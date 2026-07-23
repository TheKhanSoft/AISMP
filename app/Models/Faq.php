<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Sortable;

class Faq extends Model
{
    use Sortable;

    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
