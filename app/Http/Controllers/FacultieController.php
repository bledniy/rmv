<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Faculty\Faculty;
use Illuminate\Http\Request;

class FacultieController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\Faculty  $facultie
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $facultie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\Faculty  $facultie
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $facultie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\Faculty  $facultie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $facultie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\Faculty  $facultie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $facultie)
    {
        //
    }
}
