<?php

namespace App\Http\Controllers;

use App\Policy;
use App\User;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::paginate(10);
        //dd($policies->toArray());
        return view('hrms.policy.index', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emps = User::get();
        $managers = User::whereHas('role', function ($q) {
            $q->where('role_id', '16');
        })->get();

        $leaders = User::whereHas('role', function ($q) {
            $q->where('role_id', '5');
        })->get();

        return view('hrms.policy.add');
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
            'title' => 'required',
            'description' => 'required',
        ]);

        $policyInput = $request->all();
        Policy::create($policyInput);

        return redirect()->route('policy.index')->with('flash_message', 'Policy successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //dd($policy->toArray());
        return view('hrms.policy.show', compact('policy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        //dd($policy->toArray());
        return view('hrms.policy.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        //dd($policy->toArray());
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $policyInput = $request->all();
        $policy->update($policyInput);

        return redirect()->route('policy.edit', $policy->id)->with('flash_message', 'Policy successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        //dd($policy->toArray());
        $policy->delete();

        return redirect()->route('policy.index')->with('flash_message', 'Policy successfully deleted!');
    }

    /*old design policy page*/
    public function policies(){
        $policies = Policy::get();
        //dd($policies->toArray());
        return view('hrms.policy.policies', compact('policies'));
    }
}
