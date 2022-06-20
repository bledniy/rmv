<?php

if (!function_exists('isRobot')) {
    function isRobot(): bool
    {
        static $isRobot;
        if (null === $isRobot) {
            $isRobot = \Agent::isRobot();
        }

        return $isRobot;
    }
}

/**
 * Seo optimization for google page speed, aos animation make error on display main content to robot
 */
if (!function_exists('seoAnimation')) {
    function seoAnimation(?string $str = '', ?string $ifRobot = ''): bool
    {
        return isRobot() ? $ifRobot : $str;
    }
}

