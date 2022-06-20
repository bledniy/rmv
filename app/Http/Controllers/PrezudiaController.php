<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Faculty\Faculty;
use App\Repositories\FacultyRepository;
use App\Repositories\StaffRepository;
use Illuminate\Http\Request;

class PrezudiaController extends Controller
{
    /**
     * @var StaffRepository
     */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepository)
   {
       $this->staffRepository = $staffRepository;
   }

    public function show()
    {
        $head = $this->staffRepository->where('sort', 1)->first();
        $deputyHead = $this->staffRepository->where('sort', 2)->first();
        $secy = $this->staffRepository->where('sort', 3)->first();
        $heads = $this->staffRepository->where('type', 'head')->get();
        $with = compact(array_keys(get_defined_vars()));

        return view('public.prezudia.show')->with($with);
    }
}
