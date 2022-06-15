<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Repositories\DepartmentRepository;
use App\Repositories\StaffRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var StaffRepository
     */
    private $staffRepository;

    public function __construct(DepartmentRepository $departmentRepository, StaffRepository $staffRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->staffRepository = $staffRepository;
    }

    public function show($departmentId)
    {
        $item = $this->departmentRepository->find($departmentId);
        $head = $this->staffRepository->where('department_id', $departmentId)->where('type', 'head')->first();
        $with = compact(array_keys(get_defined_vars()));

        return view('public.department.index')->with($with);
    }
}
