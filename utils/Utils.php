<?php

namespace app\utils;

class Utils {

    public static function getDate($ddmmyyyy = '') {
        if(!empty($ddmmyyyy)) {
            return date('Y-m-d', strtotime(str_replace('/', '-', $ddmmyyyy)));
        }
        return date('Y-m-d');
    }

    public static function getData($yyyymmdd = '') {
        if(!empty($yyyymmdd)) {
            return date("d/m/Y", strtotime($yyyymmdd));
        }
        return date('d/m/Y');
    }

}