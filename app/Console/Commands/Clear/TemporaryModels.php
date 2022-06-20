<?php

namespace App\Console\Commands\Clear;

use App\Repositories\TemporaryRepository;
use Illuminate\Console\Command;

class TemporaryModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-temporary:default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all temporary data from database';
    /**
     * @var TemporaryRepository
     */
    private $temporaryRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
    public function handle()
    {
        $count = $this->temporaryRepository->deleteExpired();
        $this->info(sprintf('Deleted %s records', $count));

        return 1;
    }
}
