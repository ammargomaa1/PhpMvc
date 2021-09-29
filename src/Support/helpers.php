<?php

use Illuminate\Application;
use Illuminate\View\View;

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('env')) {
    function env($key, $default=null)
    {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key]?: $default;
        }

        return $default;
    }
}

if (!function_exists('app')) {
    function app()
    {
        static $instance = null;

        if (!$instance) {
            $instance = new Application;
        }

        return $instance;
    }
}
if (!function_exists('view_path')) {
    function view_path()
    {
        return base_path().'views/';
    }
}

if (!function_exists('view')) {
    function view($view, $params = [])
    {
        echo View::make($view, $params);
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('config_path')) {
    function config_path()
    {
        return base_path().'config/';
    }
}

if (!function_exists('config')) {
    function config($key=null, $default = null)
    {
        if (is_null($key)) {
            return app()->config;
        }

        if (is_array($key)) {
            return app()->config->set($key);
        }

        return app()->config->get($key,$default);
    }
}
