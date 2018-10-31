<?php
use Illuminate\Support\Facades\Route;

/**
 * Created by PhpStorm.
 * User: CHILLETAS
 * Date: 30/10/2018
 * Time: 01:01 PM
 */
class ActiveRoute
{
    /*
    |--------------------------------------------------------------------------
    | Detect Active Route
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    static function isActiveRoute($route, $output = "active")
    {
        if (Route::currentRouteName() == $route)
            return $output;
        return "";
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    static function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route)
        {
            if (Route::currentRouteName() == $route) return $output;
        }
        return "";
    }
}