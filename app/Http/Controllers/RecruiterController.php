<?php

namespace App\Http\Controllers;

use App\Recruiter;
use App\User;
use App\Skillset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

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

        return redirect()->route('recruiter.index')->with('flash_message', 'Recruiter successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function show(Recruiter $recruiter)
    {
        //dd($recruiter->toArray());
        $pathToFile = storage_path('app/recruiter/resume/'.$recruiter->resume);
        //dd(File::mimeType($pathToFile));

        $ext =File::extension($pathToFile);
        if($ext=='pdf'){
            $content_types='application/pdf';
        }elseif ($ext=='doc') {
            $content_types='application/msword';  
        }elseif ($ext=='docx') {
            $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';  
        }elseif ($ext=='xls') {
            $content_types='application/vnd.ms-excel';  
        }elseif ($ext=='xlsx') {
            $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  
        }elseif ($ext=='txt') {
            $content_types='application/octet-stream';  
        }

        try {
            return response()->file($pathToFile, [
                'Content-Type' => File::mimeType($pathToFile)
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('hrms.recruiter.show', compact('recruiter'));
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
