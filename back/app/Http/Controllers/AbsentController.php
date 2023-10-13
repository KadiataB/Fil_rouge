<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreabsentRequest;
use App\Http\Requests\UpdateabsentRequest;
use App\Models\absent;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreabsentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(absent $absent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateabsentRequest $request, absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(absent $absent)
    {
        //
    }
}
