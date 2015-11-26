<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 10:39
 */

/**
 * 获取指定月份的所有周末的日期
 * @param $month:On the first day of each month_
 * @return array
 */
function getNextMonthWeekend($month){
    $result[1] = date('Y-m-d', strtotime('this Saturday', strtotime($month)));
    $result[2] = date('Y-m-d', strtotime('this Sunday', strtotime($month)));
    if($result[1] > $result[2]){
        $temp = $result[2];
        $result[2] = $result[1];
        $result[1] = $temp;
    }
    // 每月最少4个周末
    for($i = 1; $i <= 3; $i++){
        $result[] = date('Y-m-d', strtotime('+' . $i . ' week', strtotime($result[1])));
        $result[] = date('Y-m-d', strtotime('+' . $i . ' week', strtotime($result[2])));
    }
    // 每月最多5个周末
    $lastSat = date('Y-m-d', strtotime('+4 week', strtotime($result[1])));
    if ($lastSat < date('Y-m-t', strtotime($month))){
        $result[] = $lastSat;
    }
    $lastSun = date('Y-m-d', strtotime('+4 week', strtotime($result[2])));
    if ($lastSun < date('Y-m-t', strtotime($month))){
        $result[] = $lastSun;
    }
    return $result;
}