<?php

namespace Database\Seeders;

use App\Repositories\DepartmentRepository;
use Faker\Generator;
use Faker\Provider\Lorem;
use Str;

class DepartmentsTableSeeder extends AbstractSeeder
{

    /**
     * @var Generator
     */
    private $factory;
    /**
     * @var DepartmentRepository
     */
    private $repository;

    public function __construct(Generator $factory, DepartmentRepository $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function run()
    {
        foreach ($this->getDepartments() as $item) {
            $item['url'] = Str::slug($item['name'] ?? '');
            $this->repository->create($item);
        }
    }

    private function getDepartments()
    {
        return [
            [
                'name' => 'НАУКОВИЙ ВІДДІЛ',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'МІЖНАРОДНИЙ ВІДДІЛ',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'ВІДДІЛ РОБОТИ З ГРОМАДСЬКІСТЮ',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
            [
                'name' => 'ПРЕС-ЦЕНТР',
                'description' => Lorem::text(150),
                'image' => $this->image($this->factory->imageUrl()),
            ],
        ];
    }
}
