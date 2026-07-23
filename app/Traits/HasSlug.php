<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->getSlugSourceColumn());
            }
        });

        static::updating(function (Model $model) {
            if ($model->isDirty($model->getSlugSourceColumn()) && empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->getSlugSourceColumn());
            }
        });
    }

    protected function getSlugSourceColumn(): string
    {
        return 'title'; // default
    }

    public function generateUniqueSlug(string $column): string
    {
        $slug = Str::slug((string) $this->{$column});
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
