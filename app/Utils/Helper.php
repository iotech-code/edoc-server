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

function dateToFullDateThai2($receive_date) {

    $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
    $receive_date = explode("/", $receive_date);
    // return $date;
    $day = intval($receive_date[0]) ;
    $month = $thaimonth[intval($receive_date[1]-1)]; 
    $year = intval($receive_date[2])+543;
    $full_date = "$day $month $year";
    
    return $full_date;
}
