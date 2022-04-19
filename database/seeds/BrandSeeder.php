<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;
use Illuminate\Foundation\Testing\WithFaker;

class BrandSeeder extends AbstractSeeder
{
    use WithFaker;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->setUpFaker();
        $this->contentRepository = $contentRepository;
    }

    public function run(): void
    {
        if (!$this->isWithDevSeed()){
            return;
        }
        $defaults = [
            'assets/img/nestle.png',
            'assets/img/myau.png',
            'assets/img/bon-buasson.png',
            'assets/img/veres.png',
            'assets/img/4lapy.png',
            'assets/img/maccofe.png',
            'assets/img/chumak.png',
            'assets/img/sorenti.png',
            'assets/img/greenfield.png',
            'assets/img/nuri.png',
            'assets/img/Italpasta.png',
            'assets/img/dar.png',
        ];
        foreach (array_reverse($defaults) as $default) {
            $brandData = ['image' => $default, 'type' => ContentTypeEnum::BRAND];
            $this->contentRepository->create($brandData);
        }
    }
}
