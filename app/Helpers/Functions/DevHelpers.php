<?php

use Illuminate\Support\Facades\Artisan;

function replaceBindingsExecutedQuery(array $q = []): string
{
    $query = $q['query'];
    $bindings = $q['bindings'];
    foreach ($bindings as $binding) {
        $query = \Illuminate\Support\Str::replaceFirst('?', $binding, $query);
    }

    return $query;
}

function getTestField($field = null, int $length = 10)
{
    if (!isLocalEnv()) {
        return '';
    }

    try {
        static $faker;
        if (null === $faker) {
            $faker = Faker\Factory::create();
        }

        switch ($field) {
            case 'phone':
                return '+38(093)' . random_int(1000000, 9999999);
                break;
            case 'name':
                return $faker->firstName();
                break;
            case 'surname':
                return $faker->lastName();
                break;
            case 'email':
                return $faker->email;
                break;
            case 'fio':
                return $faker->firstName() . ' ' . $faker->lastName;
                break;
            case 'message':
            case 'comment':
                return $faker->realText();
                break;
            case 'password':
                return 'qweqweqwe';
                break;
            case 'password_new':
            case 'password_new_confirmation':
                return 'asdasdasd';
                break;
            case 'table_number':
            case 'person':
                return $faker->randomNumber($length);
        }
    } catch (\Throwable $e) {
        app(\App\Helpers\Debug\LoggerHelper::class)->error($e);
    }

    return \Illuminate\Support\Str::random($length);
}


function seedByClass(string $class)
{
    try {
        Artisan::call('db:seed', ['--class' => $class, '--force' => 'true']);
    } catch (\Throwable $e) {
        app('log')->error($e->getMessage());
    }
}


if (!function_exists('grepClassMethods')) {
    function grepClassMethods($class, $needle = ''): array
    {
        $methods = [];
        if (is_object($class) && $needle) {
            $methods = get_class_methods($class);
            $methods = array_filter($methods, function ($item) use ($needle) {
                $pos = stripos($item, $needle);

                return false !== $pos;
            });
        }

        return $methods;
    }
}

function extractDigits($input): string
{
    return (string)preg_replace('/[^0-9]/', '', (string)$input);
}

function replaceFileExtensionInPath(string $path, string $from, string $to)
{
    if (!is_dir($path)) {
        return false;
    }
    $files = scandir($path);
    $files = array_filter($files, function ($item) use ($from) {
        return \Illuminate\Support\Str::endsWith($item, $from);
    });
    try {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $newPath = $path . DIRECTORY_SEPARATOR . \Illuminate\Support\Str::replaceLast($from, $to, $file);
            rename($path . DIRECTORY_SEPARATOR . $file, $newPath);
        }
    } catch (\Throwable $e) {

    }

    return $paths;
}

function floatToDouble($float, $decimals = 2): float
{
    return (float)number_format((float)$float, $decimals, '.', '');
}