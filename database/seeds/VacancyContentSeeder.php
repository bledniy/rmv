<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Contents\ContentFieldsTypeInterface;
use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;
use Illuminate\Foundation\Testing\WithFaker;

class VacancyContentSeeder extends AbstractSeeder
{
    use WithFaker;

    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->setUpFaker();
        $this->contentRepository = $contentRepository;
    }

    public function run(): void
    {
        if (!$this->isWithDevSeed()) {
            return;
        }
        foreach (range(1, 6) as $i) {
            $defaults[] = [
                ContentFieldsTypeInterface::NAME => $this->faker->jobTitle,
                ContentFieldsTypeInterface::DESCRIPTION => $this->faker->realText(500),
            ];
        }
        foreach ($defaults ?? [] as $default) {
            $default['type'] = ContentTypeEnum::VACANCY;
            $this->contentRepository->create($default);
        }
    }
}
