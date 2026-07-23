<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSeo
{
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?: $this->title ?? $this->name ?? null,
        );
    }

    protected function metaDescription(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?: $this->excerpt ?? $this->description ?? null,
        );
    }
}
