<?php

namespace App\Http\Controllers;

use App\Stamp;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class StampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stamps = Stamp::paginate(5);
        //dd($stamps->toArray());
        return view('hrms.stamp.index', compact('stamps'));
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

        return view('hrms.stamp.add', compact('emps', 'managers', 'leaders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request );

        $request->validate([
            'title' => 'required',
            'picture' => 'required|image',
        ]);

        $stampInput = $request->all();
        $path = $request->file('picture')->store('stamps');
        $stampInput['picture'] = basename($path);
        Stamp::create($stampInput);

        return redirect()->route('stamp.index')->with('flash_message', 'Stamp successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function show(Stamp $stamp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function edit(Stamp $stamp)
    {
        //dd($stamp->toArray());
        return view('hrms.stamp.edit', compact('stamp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stamp $stamp)
    {
        //dd($stamp->toArray());
        
        $request->validate([
            'title' => 'required',
        ]);

        $stampInput = $request->all();
        if( $request->hasFile('picture') ){
            Storage::delete("stamps/".$stamp->picture);
            $stampInput['picture'] = basename($request->file('picture')->store('stamps'));
        }
        $stamp->update($stampInput);

        return redirect()->route('stamp.edit', $stamp->id)->with('flash_message', 'Stamp successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stamp  $stamp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stamp $stamp)
    {
        //dd($stamp->toArray());
        Storage::delete("stamps/".$stamp->picture);
        $stamp->delete();

        return redirect()->route('stamp.index')->with('flash_message', 'Stamp successfully deleted!');
    }
}
