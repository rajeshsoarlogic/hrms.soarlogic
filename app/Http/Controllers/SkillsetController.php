<?php

namespace App\Http\Controllers;

use App\Skillset;
use App\User;
use Illuminate\Http\Request;

class SkillsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skillset::paginate(10);
        //dd($skills->toArray());
        return view('hrms.skillset.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emps = User::whereHas('role', function ($q) {
            $q->whereNotIn('role_id', [1,2]);
        })->with('employee')->get();
        //dd($emps->toArray());

        return view('hrms.skillset.add', compact('emps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request->toArray() );

        $request->validate([
            'title' => 'required|unique:skillsets',
        ]);

        $skillsetInput = $request->all();
        Skillset::create($skillsetInput);
        
        return redirect()->route('skill-set.index')->with('flash_message', 'Skill successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function show(Skillset $skillset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function edit(Skillset $skill, $id)
    {
        //dd($skill->toArray());

        $skill = Skillset::whereid($id)->first();

        return view('hrms.skillset.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->toArray());

        $request->validate([
            'title' => 'required|unique:skillsets',
        ]);

        $skillsetInput = $request->all();
        $Skillset = Skillset::findOrFail($id);
        $Skillset->update($skillsetInput);
        
        return redirect()->route('skill-set.edit', $id)->with('flash_message', 'Skill successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skillset  $skillset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skillset $skillset, $id)
    {
        $skillset = Skillset::find($id);
        //dd($skillset->toArray());
        $skillset->delete();

        return redirect()->route('skill-set.index')->with('flash_message', 'skill successfully deleted!');
    }
}
