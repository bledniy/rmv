<?php


if (!function_exists('isLink')) {
    function isLink($str = null)
    {
        return filter_var($str, FILTER_VALIDATE_URL);
    }
}