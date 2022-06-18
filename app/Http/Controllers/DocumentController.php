<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Document\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
    /**
     * @throws Exception
     */
    public function show($file)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Document $document
     * @return Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
