<?php

declare(strict_types=1);

namespace johnykvsky\Utils;

class ArrayHelper
{
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
    public static function merge(array $array1, array $array2, bool $deep = true): array
    {
        if (static::isAssoc($array2)) {
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
        } else {
            foreach ($array2 as $value) {
                if (!in_array($value, $array1, true)) {
                    $array1[] = $value;
                }
            }
        }

        return $array1;
    }
}
