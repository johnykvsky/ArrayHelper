<?php

namespace johnykvsky\Utils;

class ArrayHelper
{
    /**
     * Parents can be string: 'user.lastName' or array: array('user','lastName')
     * @param array $array ie. array('user'=>array('lastName'=>'Smith','firstName'=>'John'))
     * @param array|string $parents path to the key, ie. 'user.lastName';
     * @param string $glue Parents glue, by default it's dot (.)
     * @return mixed
     */
    public static function getValue($array, $parents, $default = null, $glue = '.')
    {
        if (empty($array)) {
            return $default;
        }

        if (!is_array($array)) {
            return $default;
        }

        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $ref = &$array;

        foreach ((array)$parents as $parent) {
            if (is_array($ref) && array_key_exists($parent, $ref)) {
                $ref = &$ref[$parent];
            } else {
                return $default;
            }
        }
        return $ref;
    }

    /**
     * Parents can be string: 'user.lastName' or array array('user','lastName')
     * @param array $array ie. array('user'=>array('lastName'=>'Smith','firstName'=>'John'))
     * @param array|string $parents path to the key, ie. 'user.lastName';
     * @param mixed $value Value to be set
     * @param string $glue Parents glue, by default it's dot (.)
     * @return array
     */
    public static function setValue($array, $parents, $value, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, (string) $parents);
        }

        $ref = &$array;

        foreach ($parents as $parent) {
            if (isset($ref) && !is_array($ref)) {
                $ref = array();
            }

            $ref = &$ref[$parent];
        }

        $ref = $value;

        return $array;
    }

    /**
     * Parents can be string: 'user.lastName' or array array('user','lastName')
     * @param array $array ie. array('user'=>array('lastName'=>'Smith','firstName'=>'John'))
     * @param array|string $parents path to the key, ie. 'user.lastName';
     * @param string $glue Parents glue, by default it's dot (.)
     * @return void
     */
    public static function unsetValue(&$array, $parents, $glue = '.')
    {
        if (!is_array($parents)) {
            $parents = explode($glue, $parents);
        }

        $key = array_shift($parents);

        if (empty($parents)) {
            unset($array[$key]);
        } else {
            static::unsetValue($array[$key], $parents);
        }
    }

    /**
     * Check if $array is associative
     * @param array $array Array to be checked
     * @return boolean
     */
    public static function isAssoc(array $array)
    {
        // Keys of the array
        $keys = array_keys($array);

        // If the array keys of the keys match the keys, then the array must
        // not be associative (e.g. the keys array looked like {0:0, 1:1...}).
        return array_keys($keys) !== $keys;
    }

    /**
     * Merge two arrays
     * @param array $array1 First array
     * @param array $array2 Second array
     * @param boolean $deep If false, values that are arrays are not merged, but replaced by $array2 values
     */
    public static function merge($array1, $array2, $deep = true)
    {
        if (static::isAssoc($array2)) {
            foreach ($array2 as $key => $value) {
                if (is_array($value) and isset($array1[$key]) and is_array($array1[$key]) and $deep) {
                    $array1[$key] = static::merge($array1[$key], $value, $deep);
                } else {
                    $array1[$key] = $value;
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
