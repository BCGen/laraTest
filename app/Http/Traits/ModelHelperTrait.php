<?php

namespace App\Http\Traits;

trait ModelHelperTrait
{
    public static function bootModelHelperTrait()
    {
        static::updating(function ($model) {
            foreach ($model->attributes as $key => $value) {
                if (ends_with($key, '_url') && array_key_exists($key, $model->original)) {
                    if ($model->attributes[$key] !== $model->original[$key]) {
                       MediaTrait::deleteFile($model->original[$key]);
                    }
                }
            }
        });

        static::deleting(function ($model) {
            foreach ($model->original as $key => $value) {
                if (ends_with($key, '_url')) {
                    MediaTrait::deleteFile($model->original[$key]);
                }
            }
        });
    }
}
