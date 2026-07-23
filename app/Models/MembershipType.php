<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Sortable;

class MembershipType extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'description',
        'fee',
        'duration_months',
        'features',
        'is_active',
        'order',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'duration_months' => 'integer',
        'features' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
