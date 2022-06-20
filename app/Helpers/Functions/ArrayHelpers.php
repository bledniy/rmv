<?php
if (!function_exists('isLast')) {
    function isLast($array, $key)
    {
        $last_key = key(array_slice($array, -1, 1, true));
        if ($last_key === $key) {
            return true;
        }

        return false;
    }
}

function arrayEachPrepend(array $array, $prepend): array
{
    return array_map(function ($item) use ($prepend) {
        return $prepend . $item;
    }, $array);
}


if (!function_exists('makeRowsKey')) {
    /**
     * @param $array
     * @param $key
     * @param $value
     * @return array
     * Метод генерирует массив ключ значение из переданного массива где ключем является переданный ключ
     * а значением соответственно поле value
     */
    function makeRowsKey($array, $key, $value)
    {
        $return = [];
        foreach ($array as $item) {
            $return[$item[$key]] = $item[$value];
        }

        return $return;
    }
}


if (!function_exists('keyBy')) {
    /**
     * @param        $array
     * @param string $id = 'id'
     *
     * @return array
     * Метод оборачивает каждый вложенный массив укзанным идентификатором
     * $array[0] = ['id' => 10, 'name' => 'John']
     * Превратит в
     * $array[10] = ['id' => 10, 'name' => 'John']
     */
    function keyBy($array, $id = 'id')
    {
        $return = [];
        foreach ($array as $item) {
            $return[$item[$id]] = $item;
        }

        return $return;
    }
}

if (!function_exists('remakeKeyValue')) {
    function remakeKeyValue($values)
    {
        $valuesRemake = [];
        if (\Arr::has($values, 'key')) {
            foreach (\Arr::get($values, 'key') as $index => $key) {
                $value = \Arr::get(\Arr::get($values, 'value'), $index);
                $valuesRemake[] = [
                    'key' => $key,
                    'value' => $value,
                ];
            }
        }

        return $valuesRemake;
    }
}

function arrayValueAsKey(array $array): array
{
    foreach ($array as $key => &$value) {
        $value = $key;
    }

    return $array;
}


function arrayKeyAsValue(array $array): array
{
    $array = array_combine($array, $array);

    return $array;
}


function getLastFromExploded(string $name, string $delimiter = '.')
{
    $parts = explode($delimiter, $name);

    return end($parts);
}


if (!function_exists('implodeComma')) {
    function implodeComma(array $array, $glue = ',')
    {
        return implode($glue, $array);
    }
}

function sortArrayByArray(array $origin, array $order): array
{
    $order = array_flip($order);
    uksort($origin, static function ($a, $b) use ($order) {
        $pos_a = $order[$a] ?? false;
        $pos_b = $order[$b] ?? false;

        return $pos_a - $pos_b;
    });

    return $origin;
}