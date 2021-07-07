<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::paginate(10);
        //dd($templates->toArray());
        return view('hrms.template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrms.template.add');
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

        $templateInput = $request->all();
        Template::create($templateInput);

        return redirect()->route('template.index')->with('flash_message', 'Template successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //dd($template->toArray());
        return view('hrms.template.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //dd($request->toArray());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $templateInput = $request->all();
        $template->update($templateInput);

        return redirect()->route('template.edit', $template->id)->with('flash_message', 'Template successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //dd($template->toArray());
        $template->delete();

        return redirect()->route('template.index')->with('flash_message', 'Template successfully deleted!');
    }
}
