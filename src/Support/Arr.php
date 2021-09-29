<?php

namespace Illuminate\Support;

use ArrayAccess;

class Arr
{
    public static function only(array $items, array $keys)
    {
        return array_intersect_key($items, array_flip((array) $keys));
    }

    public static function setAccessability(array $items, $key)
    {
        return is_array($items[$key]);
    }

    public static function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists($items, $key)
    {
        if ($items instanceof ArrayAccess) {
            return $items->offsetExists($key);
        }

        return array_key_exists($key, $items);
    }

    public static function set(&$array, $key, $value)
    {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);
        

        //while you have keys

        while (count($keys)>1) {
            $key = array_shift($keys);

            if (!Arr::exists($array, $key)||!Arr::accessible($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    public static function add($array, $key, $value)
    {
        if (is_null(static::get($array, $key))) {
            static::set($array, $key, $value);
        }

        return $array;
    }


    public static function first($array, $callBack = null, $default = null)
    {
        if (is_null($callBack)) {
            if (empty($array)) {
                return value($default);
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $item) {
            return $callBack($item);
        }

        return value($default);
    }

    public static function last($array, $callBack = null, $default = null)
    {
        if(is_null($callBack)){
            return empty($array) ? value($default) : end($array);
        }

        return static::first(array_reverse($array),$callBack,$default);
    }

    public static function get($array,$key,$default = null){
        if(!static::accessible($array)){
            return value($default);
        }

        if(static::exists($array,$key)){
            return $array[$key];
        }

        if(!str_contains($key,'.')){
            return $array[$key] ?? value($default);
        }

        foreach(explode('.',$key) as $segment){
            if(static::accessible($array) && static::exists($array,$segment)){
                $array = $array[$segment];
            }else{
                return value($default);
            }
        }
        return $array;
    }

    public static function has($array, $keys)
    {
        if (is_null($keys)) {
            return false;
        }

        $keys = (array) $keys;

        if (!$array) {
            return false;
        }

        if ($keys === []) {
            return false;
        }

        $subKeyArray = $array;

        foreach ($keys as $key) {
            
            if (static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (static::accessible($subKeyArray) && static::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }
    public static function forget(&$array, $keys)
    {
        $original = &$array;

        $keys = (array) $keys;

        if (count($keys) === 0) {
            return;
        }

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }
}
