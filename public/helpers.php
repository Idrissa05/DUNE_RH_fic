<?php
/**
 * Formate une date passer en paramètre
 * @param string $date
 * @param string $format
 * @return string
 */
function formaterDate(string $date, string $format = 'd/m/Y') {
    $myDate = date_create($date);
    return $myDate->format($format);
}