<?php

require_once('./vendor/autoload.php');

/**
 * Question:
 * Prepare a function that add up these two arrays into one,
 * you can use laravel collection or native php of your like
 */
$arr1 = [
    ['name' => 'Jillberth Estillore', 'goals' => 0, 'assists' => 0, 'points' => 0],
    ['name' => 'Khegi Walesa', 'goals' => 2, 'assists' => 1, 'points' => 3],
    ['name' => 'Faisal Khursheed', 'goals' => 1, 'assists' => 1, 'points' => 2],
    ['name' => 'Kirill', 'goals' => 5, 'assists' => 7, 'points' => 12],
];

$arr2 = [
    ['name' => 'Kirill', 'goals' => 3, 'assists' => 3, 'points' => 6, 'ppg' => 0, 'ppa' => 0, 'pims' => 0],
    ['name' => 'Khegi Walesa', 'goals' => 1, 'assists' => 4, 'points' => 5, 'ppg' => 0, 'ppa' => 1, 'pims' => 0],
    ['name' => 'Jillberth Estillore', 'goals' => 0, 'assists' => 0, 'points' => 0, 'ppg' => 0, 'ppa' => 0, 'pims' => 0],
    ['name' => 'Faisal Khursheed', 'goals' => 0, 'assists' => 0, 'points' => 0, 'ppg' => 0, 'ppa' => 0, 'pims' => 0],
];


function addItUp(...$arraysOfData)
{
    // Your code goes here

    usort($arraysOfData[0], function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    usort($arraysOfData[1], function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    $arrResult = [];

    foreach ($arraysOfData[0] as $key => $value) {
    
        if ($value['name'] == $arraysOfData[1][$key]['name']) {

            $arrResult[$key] = [
                'name' => $value['name'],
                'goals' => (isset($arraysOfData[1][$key]['goals']) ? $arraysOfData[1][$key]['goals'] : 0) + (isset($value['goals']) ? $value['goals'] : 0),
                'assists' => (isset($arraysOfData[1][$key]['assists']) ? $arraysOfData[1][$key]['assists'] : 0) + (isset($value['assists']) ? $value['assists'] : 0),
                'points' => (isset($arraysOfData[1][$key]['points']) ? $arraysOfData[1][$key]['points'] : 0) + (isset($value['points']) ? $value['points'] : 0),
                'ppg' => (isset($arraysOfData[1][$key]['ppg']) ? $arraysOfData[1][$key]['ppg'] : 0) + (isset($value['ppg']) ? $value['ppg'] : 0),
                'ppa' => (isset($arraysOfData[1][$key]['ppa']) ? $arraysOfData[1][$key]['ppa'] : 0) + (isset($value['ppa']) ? $value['ppa'] : 0),
                'pims' => (isset($arraysOfData[1][$key]['pims']) ? $arraysOfData[1][$key]['pims'] : 0) + (isset($value['pims']) ? $value['pims'] : 0)
            ];
        }
    }

    return $arrResult;
}

consoleTable(addItUp($arr1, $arr2));

