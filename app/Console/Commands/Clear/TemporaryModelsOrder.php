<?php

namespace App\Console\Commands\Clear;

use App\Repositories\TemporaryRepository;
use Illuminate\Console\Command;

class TemporaryModelsOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-temporary:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all temporary data of deals from database';
    /**
     * @var TemporaryRepository
     */
    private $temporaryRepository;

    public function __construct(TemporaryRepository $temporaryRepository)
    {
        parent::__construct();
        $this->temporaryRepository = $temporaryRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $list = $this->temporaryRepository->getExpiredListByType('order-create');
        foreach ($list as $temporary) {
            $data = $temporary->getData();
            if (isset($data['uploads'])) {
                foreach ($data['uploads'] as $upload) {
                    if (storageFileExists($upload['path'])) {
                        storageDelete($upload['path']);
                    }
                }
            }
            $this->temporaryRepository->delete($temporary);
        }

        return 1;
    }
}
