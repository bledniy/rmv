<?php

namespace Database\Seeders;

use App\Repositories\FacultyRepository;
use Faker\Generator;
use Faker\Provider\Lorem;

class FacultiesTableSeeder extends AbstractSeeder
{

    /**
     * @var Generator
     */
    private $factory;
    /**
     * @var FacultyRepository
     */
    private $repository;

    public function __construct(Generator $factory, FacultyRepository $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function run()
    {
        foreach ($this->getFaculties() as $item) {
            $this->repository->create($item);
        }
    }

    private function getFaculties()
    {
        return [
            [
                'name' => 'Біологічний факультет',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Геолого-географічний факультет',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Економіко-правовий факультет',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет історії та філософії',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет журналістики, реклами та видавничої справи',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет математики, фізики та інформаційних технологій',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет міжнародних відносин, політології та соціології',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет психології та соціальної роботи',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет романо-германської філології',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Філологічний факультет',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Факультет хімїї та фармації',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Міжвідомчий науково-навчальний фізико-технічний центр',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Біотехнологічний науково-навчальний центр',
                'description' => Lorem::text(150),
            ],
            [
                'name' => 'Асоційовані члени Ради',
                'description' => Lorem::text(150),
            ],
        ];
    }
}
