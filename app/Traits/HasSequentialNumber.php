<?php

namespace App\Traits;

use App\Models\CompanyCounter;

trait HasSequentialNumber
{
    public static function bootHasSequentialNumber()
    {
        static::creating(function ($model) {
            if (is_null($model->number) && $model->company_id) {
                $entityType = strtolower(class_basename($model));
                $model->{$entityType . '_number'} = CompanyCounter::getNextNumber($model->company_id, $entityType);
            }
        });
    }
}
