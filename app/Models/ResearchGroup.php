<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasSlug;

class ResearchGroup extends Model
{
    use HasSlug;

    protected $fillable = [
        'leader_id',
        'name',
        'slug',
        'description',
        'focus_areas',
    ];

    protected $casts = [
        'focus_areas' => 'array',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'research_group_members')
            ->withPivot('role', 'joined_at');
    }
}
