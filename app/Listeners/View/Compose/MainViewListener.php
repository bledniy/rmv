<?php declare(strict_types=1);

namespace App\Listeners\View\Compose;

use App\Repositories\DepartmentRepository;
use App\Repositories\FacultyRepository;

class MainViewListener
{
    private static $isLoaded = false;
    /**
     * @var FacultyRepository
     */
    private $facultyRepository;
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    public function __construct(FacultyRepository $facultyRepository, DepartmentRepository $departmentRepository)
    {

        $this->facultyRepository = $facultyRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function handle($event)
    {
        if (!$this->supports()) {
            return;
        }
        self::$isLoaded = true;

        $faculties = $this->facultyRepository->all();
        $departments = $this->departmentRepository->all();

		$with = compact(array_keys(get_defined_vars()));
		\view()->share($with);
    }

    private function supports(): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }
        if (self::$isLoaded) {
            return false;
        }

        return true;
    }
}
