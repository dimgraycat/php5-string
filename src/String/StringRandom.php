<?php

namespace String;

class StringRandom {

    protected static $strings = array(
        '0-9' => array(
            'number',
            'digit',
        ),
        'a-z' => array(
            'small', 'small-letter', 'sletter',
            'lower', 'lower-case', 'lc'
        ),
        'A-Z' => array(
            'big', 'capital-letter', 'cletter',
            'upper', 'upper-case', 'uc'
        ),
        '!-/ :-@ [-` {-~' => array(
            'symbol'
        ),
    );

    public static function create($range_strings='0-9 0-9 a-z A-Z', $length=8) {
        if (empty($range_strings)) return '';

        $range_strings = static::_replace($range_strings);
        $rows = explode(' ', $range_strings);
        $array = array();
        foreach ($rows as $row) {
            $tmp = explode('-', $row);
            $cnt = count($tmp);
            if($cnt > 1) {
                $range = ($cnt == 2) ? range($tmp[0], $tmp[1]) : range($tmp[0], $tmp[1], $tmp[2]);
                if($cnt == 3) {
                    $t = join('', $range);
                    $range = preg_split('//', $t, -1, PREG_SPLIT_NO_EMPTY);
                }
                shuffle($range);
                $array[] = $range;
            }
            else {
                $range = preg_split('//', $row, -1, PREG_SPLIT_NO_EMPTY);
                shuffle($range);
                $array[] = $range;
            }
        }

        $result = array();
        while (count($result) < $length) {
            $key = array_rand($array);
            $result[] = $array[$key][array_rand($array[$key])];
        }
        shuffle($result);
        return str_shuffle(join('', $result));
    }

    private static function _replace($subject) {
        foreach (static::$strings as $replace => $values) {
            foreach ($values as $search) {
                $subject = str_replace($search, $replace, $subject);
            }
        }
        return $subject;
    }
}
