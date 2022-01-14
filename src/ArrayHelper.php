<?php

declare(strict_types=1);

namespace johnykvsky\Utils;

class ArrayHelper
{
    public static function merge(array $array1, array $array2, bool $deep = true): array
    {
        if (static::isAssoc($array2)) {
            return static::mergeAssociative($array1, $array2, $deep);
        }

        return static::mergeAssociative($array1, $array2);
    }

    public static function isAssoc(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    public static function mergeAssociative(array $array1, array $array2, bool $deep = true): array
    {
        foreach ($array2 as $key => $value) {
            if ($deep && is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
                $array1[$key] = static::merge($array1[$key], $value, $deep);
                continue;
            }

            is_int($key) ? $array1[] = $value : $array1[$key] = $value;
        }

        return $array1;
    }

    public static function mergeNonAssociative(array $array1, array $array2): array
    {
        foreach ($array2 as $value) {
            if (!in_array($value, $array1, true)) {
                $array1[] = $value;
            }
        }

        return $array1;
    }

    public static function combine(array $array1, array $array2): array
    {
        foreach ($array2 as $value) {
            $array1[] = $value;
        }

        return $array1;
    }

    public static function firstValue(array $array): mixed
    {
        return current(array_slice($array, 0));
    }

    public static function lastValue(array $array): mixed
    {
        return current(array_slice($array, -1));
    }

    public static function flatten(array $input): array
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($input));
        return iterator_to_array($iterator, false);
    }
}
