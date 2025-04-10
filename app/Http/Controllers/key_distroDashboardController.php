<?php

namespace App\Http\Controllers;

use App\Models\key_distro;
use App\Models\client;
use Illuminate\Http\Request;

class key_distroDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client =client::where('distro_id',auth()->user()->id)->count();
        return view('dashboard.kdDashboard',compact('client'));
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
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function show(key_distro $key_distro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function edit(key_distro $key_distro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, key_distro $key_distro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function destroy(key_distro $key_distro)
    {
        //
    }
}
