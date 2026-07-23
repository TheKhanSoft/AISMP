<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipRenewal extends Model
{
    protected $fillable = [
        'membership_id',
        'amount_paid',
        'renewal_date',
        'new_end_date',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'renewal_date' => 'date',
        'new_end_date' => 'date',
    ];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
