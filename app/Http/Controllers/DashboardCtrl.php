<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('starter.dashboardv1');
    }

    /**
     * Display the specified resource.
     */
    public function search(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    
}
