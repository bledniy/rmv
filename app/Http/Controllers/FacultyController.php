<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Faculty\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.faculty.index');
    }
}
