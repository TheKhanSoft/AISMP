<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field => $value) {
            if (!empty($value)) {
                if (in_array($field, $this->getFillable())) {
                    $query->where($field, $value);
                }
            }
        }
        return $query;
    }
}
