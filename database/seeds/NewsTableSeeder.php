<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Helpers\Debug\LoggerHelper;
use App\Repositories\NewsRepository;
use Faker\Generator;
use Illuminate\Support\Str;

class NewsTableSeeder extends AbstractSeeder
{
    protected $categories;

    private $repository;

    private $factory;

    public function __construct(NewsRepository $repository, Generator $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->reguard();
    }

    public function run(): void
    {
        if (!$this->isWithDevSeed()) {
            return;
        }
        $news = $this->getNews();
        $this->command->getOutput()->progressStart(count($news));
        foreach ($news as $item) {
            try {
                $this->repository->create($item);
            } catch (\Throwable $e) {
                app(LoggerHelper::class)->error($e);
            }
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }


    /**
     * @return array
     */
    private function getNews(): array
    {
        $news = [];
        foreach (range(1, 15) as $item) {
            $name = $this->factory->jobTitle;
            $news[] = [
                'published_at' => $this->factory->date('Y-m-d H:i:s'),
                'name' => $name,
                'title' => $this->factory->city,
                'description' => $this->factory->text,
                'excerpt' => $this->factory->text(160),
                'image' => $this->image($this->factory->imageUrl()),
                'url' => Str::slug($name . Str::random(2)),
            ];
        }

        return $news;
    }
}

