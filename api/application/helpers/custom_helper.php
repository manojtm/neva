<?php

function dd($data, $exit = TRUE)
{
    echo "<pre>";
    if ( is_array($data) ) print_r($data);
    else var_dump($data);
    echo "</pre>";

    if ( $exit ) exit;
}

function lq()
{
    $CI =& get_instance();
    echo "<pre>";
    $CI->db->last_query();
    echo "</pre>";
    exit;
}

function mem($memory)
{
    // $memory = memory_get_usage(true);
    if ($memory < 1024) echo $memory . " bytes";
    elseif ($memory < 1048576) echo round($memory / 1024, 2) . " kilobytes";
    else echo round($memory / 1048576, 2) . " megabytes";
    echo "<br/>";
    exit;
}

/**
 * @param $date1
 * @param $date2
 * @param string $interval years, months, weeks, days, hours, minutes, seconds
 * @return float|string
 */
function __dateDiff($date1,$date2,$interval='years')
{
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $diff = $datetime1->diff($datetime2);
    switch($interval) {
        case 'years':
            return $diff->format('%y');
        case 'months':
            return ($diff->format('%y') * 12) + $diff->format('%m');
        case 'weeks':
            return floor($diff->format('%a') / 7);
        case 'days':
            return $diff->format('%a');
        case 'hours':
            return $diff->format('%h') + ($diff->format('%a')*24);
        case 'minutes':
            return $diff->format('%i') + ($diff->format('%a')*24*60);
        case 'seconds':
            return $diff->format('%s') + ($diff->format('%a')*24*60*60);
    }
}


function slug($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
    return $slug;
}
