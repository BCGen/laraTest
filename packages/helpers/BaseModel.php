<?php

namespace BCGen\Helpers;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        // get migration table fields
        $fields = \Schema::getColumnListing($this->getTable());

        // set table
        $this->table = str_plural(snake_case(class_basename(get_called_class())));

        // set fillable
        $this->fillable = array_filter($fields, function ($value) {
            return !in_array($value, ['id', 'created_at', 'updated_at']);
        });
    }
}
