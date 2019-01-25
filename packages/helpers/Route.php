<?php

namespace BCGen\Helpers;

use Illuminate\Support\Facades\Route as LaraRoute;

class Route
{
    public static function resources($list, $option = array())
    {
        foreach ($list as $item) {
            $result[$item] = studly_case(str_singular(snake_case($item))) . 'Controller';
        }

        if (isset($option[0])) {
            $option = ['except' => $option];
        }

        LaraRoute::resources($result, $option);
    }
}
