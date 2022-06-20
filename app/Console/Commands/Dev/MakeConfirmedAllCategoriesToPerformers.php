<?php

namespace App\Console\Commands\Dev;

use App\Models\Category\Category;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class MakeConfirmedAllCategoriesToPerformers extends Command
{
    protected $signature = 'dev:performers.confirm';

    protected $description = 'Command description';
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        if (!isLocalEnv()) {
            return 0;
        }
        $count = $this->userRepository->count();
        $limit = 100;
        foreach (range(0, floor($count / $limit)) as $item) {
            $users = User::query()->offset($item * $limit)->limit($limit)->get();
            $this->add($users);
        }

        return 1;
    }

    /**
     * @param Collection $users | User[]
     */
    private function add(Collection $users)
    {
        foreach ($users as $user) {
            /** @var $user User */
            $user->performerCategories()->sync($this->getCategories());
        }
    }

    private function getCategories(): array
    {
        static $categories;
        if (null === $categories) {
            $categories = Category::query()->pluck('id')->toArray();
        }

        return $categories;
    }
}
