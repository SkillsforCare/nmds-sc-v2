<?php

if (! function_exists('build_date')) {
    function build_date($date)
    {
        if(empty($date['year']) and empty($date['month']) and empty($date['day']))
            return null;

        return $date['year'] . '-' . $date['month']  . '-' . $date['day'];
    }
}