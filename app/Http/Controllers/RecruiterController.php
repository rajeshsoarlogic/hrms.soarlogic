<?php

namespace App\Http\Controllers;

use App\Recruiter;
use App\User;
use App\Skillset;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruiters = Recruiter::paginate(10);
        $skills = Skillset::get();
        //dd($recruiters->toArray());
        return view('hrms.recruiter.index', compact('recruiters', 'skills'));
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
        $skills = Skillset::get();
        //dd($skills->toArray());

        return view('hrms.recruiter.add', compact('emps', 'skills'));
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
            'name' => 'required',
            'skypeid' => 'required',
            'email' => 'required',
            'mobile_num' => 'required|digits:10',
            'exp_in_yrs' => 'required',
            'resume' => 'required',
            'skills' => 'required',
        ]);

        $recruiteInput = $request->all();
        $recruiteInput['skills'] = serialize($request->skills);
        $path = $request->file('resume')->store('recruiter/resume');
        $recruiteInput['resume'] = basename($path);
        Recruiter::create($recruiteInput);

        return redirect()->route('recruiter.create')->with('flash_message', 'Recruiter successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function show(Recruiter $recruiter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruiter $recruiter)
    {
        //dd($recruiter->toArray());
        $skills = Skillset::get();
        return view('hrms.recruiter.edit', compact('recruiter', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recruiter $recruiter)
    {
        //dd($request->toArray());
        $request->validate([
            'name' => 'required',
            'skypeid' => 'required',
            'email' => 'required',
            'mobile_num' => 'required|digits:10',
            'exp_in_yrs' => 'required',
            'skills' => 'required',
        ]);

        $recruiteInput = $request->all();
        $recruiteInput['skills'] = serialize($request->skills);
        if($request->hasFile('resume')){
            Storage::delete('recruiter/resume/'.$recruiter->resume);
            $recruiteInput['resume'] = basename($request->file('resume')->store('recruiter/resume'));
        }
        $recruiter->update($recruiteInput);

        return redirect()->route('recruiter.edit', $recruiter->id)->with('flash_message', 'Recruiter successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruiter $recruiter)
    {
        //dd($recruiter->toArray());
        $recruiter->delete();

        return redirect()->route('recruiter.index')->with('flash_message', 'Recruiter successfully deleted!');
    }
}
