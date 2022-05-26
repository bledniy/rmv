<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {

        $this->departmentRepository = $departmentRepository;
    }

    public function show($departmentId)
    {
        $item = $this->departmentRepository->find($departmentId);

        return view('public.department.index')->with(compact('item'));
    }
}
