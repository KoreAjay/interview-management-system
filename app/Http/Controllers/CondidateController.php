<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CondidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $candidates=Candidate::all();
        return view('candidates.index',compact('candidates'));
        
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);

        Candidate::create($request->all());

        return redirect()->route('candidates'.index)->with('success','Candidate added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
