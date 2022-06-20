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
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Геолого-географічний факультет',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Економіко-правовий факультет',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет історії та філософії',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет журналістики, реклами та видавничої справи',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет математики, фізики та інформаційних технологій',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет міжнародних відносин, політології та соціології',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет психології та соціальної роботи',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет романо-германської філології',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Філологічний факультет',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Факультет хімїї та фармації',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Міжвідомчий науково-навчальний фізико-технічний центр',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Біотехнологічний науково-навчальний центр',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'Асоційовані члени Ради',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
        ];
    }
}
