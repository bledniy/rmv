<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Faculty\Faculty;
use App\Repositories\FacultyRepository;
use App\Repositories\StaffRepository;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * @var FacultyRepository
     */
    private $facultyRepository;
    /**
     * @var StaffRepository
     */
    private $staffRepository;

    public function __construct(FacultyRepository $facultyRepository, StaffRepository $staffRepository)
   {
       $this->facultyRepository = $facultyRepository;
       $this->staffRepository = $staffRepository;
   }

    public function show($facultyId)
    {
        $faculty = $this->facultyRepository->find($facultyId);
        $staffs = $this->staffRepository->findAllByFaculty($facultyId);
        $with = compact(array_keys(get_defined_vars()));

        return view('public.faculty.show')->with($with);
    }
}
