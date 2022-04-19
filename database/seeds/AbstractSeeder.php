<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class AbstractSeeder
 * @package Database\Seeders
 * @property $faker
 */
class AbstractSeeder extends Seeder
{

    protected function image($path = null): string
    {
        if (null === $path) {
            if (!$this->faker instanceof Generator) {
                throw new \RuntimeException(sprintf('Faker not set in %s', __CLASS__));
            }
            $path = $this->faker->imageUrl();
        }
        $path = Str::replaceFirst('lorempixel.com', 'picsum.photos', $path);

        return $path . '?' . Str::random(6);
    }

    protected function reguard(): void
    {
        Model::reguard();
    }

    protected function isWithDevSeed():bool
    {
        return (bool)env('DEV_SEED');
    }
}
