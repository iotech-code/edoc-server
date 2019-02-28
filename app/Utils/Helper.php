<?php

/**
 * Convert Datetime to Thai Text
 */
function dateToFullDateThai($date) {

    $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
    $date = explode("/", $date);
    // return $date;
    $day = intval($date[0]) ;
    $month = $thaimonth[intval($date[1]-1)]; 
    $year = intval($date[2])+543;
    $full_date = "$day $month $year";
    
    return $full_date;
}