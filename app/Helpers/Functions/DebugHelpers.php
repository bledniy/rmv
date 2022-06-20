<?php

use Illuminate\Support\Arr;

if (!function_exists('d')) {
    function d()
    {
        if (isLocalEnv()) {
            $traceText = getBacktraceClass();
            dd($traceText, ...func_get_args());
        }
    }
}
if (!function_exists('du')) {
    function du()
    {
        if (isLocalEnv() || isDumpServerRunning()) {
//			$traceText = getBacktraceClass();
//			dump($traceText, ...func_get_args());
            dump(...func_get_args());
        }
    }
}

function isDumpServerRunning()
{
    static $check;
    if (null !== $check) {
        return $check;
    }
    $port = 9912;
    try {
        $connection = fsockopen('localhost', $port);
        $check = is_resource($connection);
        fclose($connection);
    } catch (\Throwable $e) {
        $check = false;
    }

    return $check;
}

function getBacktraceClass(): string
{
    $backtrace = debug_backtrace();
    array_shift($backtrace);
    $trace = array_shift($backtrace);
    $prevTrace = array_shift($backtrace);

    return '   ' . Arr::get($prevTrace, 'class') . '::' . Arr::get($prevTrace, 'function') . '        ' . Arr::get($trace, 'line');
}

if (!function_exists('isLocalEnv')) {
    function isLocalEnv()
    {
        return env('APP_ENV') === 'local' || env('APP_ENV') === 'testing';
    }
}


if (!function_exists('debugInfo')) {
    function debugInfo()
    {
        if (\Debugbar::isEnabled()) {
            \Debugbar::info(
//			getBacktraceClass(),
                ...func_get_args()
            );

            return;
        }
        if (isAdmin()) {
            du(
                ...func_get_args()
            );
        }
    }
}


function debugBackTraceFiles($limit = 15, $reverse = false)
{
    $backtrace = array_slice(debug_backtrace(), 2, $limit);

    $traceCompact = collect([]);

    foreach ($backtrace as $trace) {
        $arr = [
            'file' => Arr::get($trace, 'file', ''),
            'function' => Arr::get($trace, 'function', ''),
            'line' => Arr::get($trace, 'line', ''),
        ];
        if (!array_filter($arr)) {
            continue;
        }
        $traceCompact->push($arr);
    }
    $fileMaxLen = $traceCompact->max(static function ($item) {
        return mb_strlen($item['file']);
    });
    $functionMaxLen = $traceCompact->max(static function ($item) {
        return mb_strlen($item['function']);
    });
    $functionMaxLen += 5;
    $arr = [];
    foreach ($traceCompact as $trace) {
        $fileDiffLength = ($fileMaxLen - mb_strlen(Arr::get($trace, 'file')));
        $file = str_repeat(' ', $fileDiffLength) . Arr::get($trace, 'file') . str_repeat(' ', 5);
        $functionDiffLength = ($functionMaxLen - mb_strlen(Arr::get($trace, 'function')));
        $function = Arr::get($trace, 'function') . str_repeat(' ', $functionDiffLength);
        $line = Arr::get($trace, 'line');
        $arr[] = implode('', [$file, $function, $line]);
    }
    if ($reverse) {
        $arr = array_reverse($arr);
    }

    return $arr;
}


if (!function_exists('dumpAdmin')) {
    function dumpAdmin()
    {
        if (isSuperAdmin()) {
            dump(debug_backtrace()[0]['file'] . ' | line: ' . debug_backtrace()[0]['line']);
            $vars = func_get_args();
            dump(...$vars);
        }
    }
}

function throwIfDev(Throwable $throwable)
{
    if (isLocalEnv()) {
        throw $throwable;
    }
}
