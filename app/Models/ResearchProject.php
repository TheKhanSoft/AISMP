<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasSlug;
use App\Traits\Publishable;

class ResearchProject extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'lead_researcher_id',
        'title',
        'slug',
        'description',
        'objectives',
        'methodology',
        'start_date',
        'end_date',
        'funding_source',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function leadResearcher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_researcher_id');
    }
}
