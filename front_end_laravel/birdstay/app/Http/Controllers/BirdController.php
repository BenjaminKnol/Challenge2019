<?php

namespace App\Http\Controllers;

use App\Bird;
use Illuminate\Http\Request;

class BirdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('birds.index');
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
     * @param  \App\Bird  $bird
     * @return \Illuminate\Http\Response
     */
    public function show(Bird $bird)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bird  $bird
     * @return \Illuminate\Http\Response
     */
    public function edit(Bird $bird)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bird  $bird
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bird $bird)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bird  $bird
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bird $bird)
    {
        //
    }
}
