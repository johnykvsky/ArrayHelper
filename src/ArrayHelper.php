<?php

declare(strict_types=1);

namespace johnykvsky\Utils;

class ArrayHelper
{
    /**
     * Merge two arrays
     * @param mixed[] $array1 First array
     * @param mixed[] $array2 Second array
     * @param boolean $deep If false, values that are arrays are not merged, but replaced by $array2 values
     * @return mixed[]
     */
    public static function merge(array $array1, array $array2, bool $deep = true): array
    {
        return (static::isAssoc($array2)) ? static::mergeAssociative(
            $array1,
            $array2,
            $deep
        ) : static::mergeAssociative($array1, $array2);
    }

    /**
     * Check if $array is associative
     * @param mixed[] $array Array to be checked
     * @return boolean
     */
    public static function isAssoc(array $array): bool
    {
        // Keys of the array
        $keys = array_keys($array);

        // If the array keys of the keys match the keys, then the array must
        // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
        return array_keys($keys) !== $keys;
    }

    /**
     * Merge two arrays
     * @param mixed[] $array1 First array
     * @param mixed[] $array2 Second array
     * @param boolean $deep If false, values that are arrays are not merged, but replaced by $array2 values
     * @return mixed[]
     */
    public static function mergeAssociative(array $array1, array $array2, bool $deep = true): array
    {
        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($array1[$key]) && is_array($array1[$key]) && $deep) {
                $array1[$key] = static::merge($array1[$key], $value, $deep);
            } else {
                if (is_int($key)) {
                    $array1[] = $value;
                } else {
                    $array1[$key] = $value;
                }
            }
        }

        return $array1;
    }

    /**
     * Merge two arrays
     * @param mixed[] $array1 First array
     * @param mixed[] $array2 Second array
     * @return mixed[]
     */
    public static function mergeNonAssociative(array $array1, array $array2): array
    {
        foreach ($array2 as $value) {
            if (!in_array($value, $array1, true)) {
                $array1[] = $value;
            }
        }

        return $array1;
    }

    /**
     * Join two arrays
     * @param mixed[] $array1 First array
     * @param mixed[] $array2 Second array
     * @return mixed[]
     */
    public static function combine(array $array1, array $array2): array
    {
        foreach ($array2 as $value) {
            $array1[] = $value;
        }

        return $array1;
    }

    /**
     * Get first element from array (value), without modifying an array (like array_pop)
     * @param array $array Input array
     * @return mixed|null
     */
    public static function firstValue(array $array)
    {
        return current(array_slice($array, 0));
    }

    /**
     * Get last element from array (value), without modifying an array
     * @param array $array Input array
     * @return mixed|null
     */
    public static function lastValue(array $array)
    {
        return current(array_slice($array, -1));
    }

    /**
     * Get values from input array (recursive)
     * @param array $input Input array
     * @return array
     */
    public static function flatten(array $input): array
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($input));
        return iterator_to_array($iterator, false);
    }
}
