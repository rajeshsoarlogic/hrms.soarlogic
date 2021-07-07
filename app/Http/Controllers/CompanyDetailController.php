<?php

namespace App\Http\Controllers;

use App\CompanyDetail;
use Illuminate\Http\Request;

class CompanyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = CompanyDetail::paginate(10);
        //dd($companies->toArray());
        return view('hrms.companydetail.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrms.companydetail.add');
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
            'address' => 'required',
            'bank_details' => 'required',
            'pan' => 'required',
            'gst_num' => 'required',
            'soft_tech_num' => 'required',
            'other_details' => 'required',
        ]);

        $companyInput = $request->all();
        if($request->hasFile('moa_aoa')){
            $companyInput['moa_aoa'] = basename( $request->file('moa_aoa')->store('moa_aoa') );
        }
        if($request->hasFile('mca_certificate')){
            $companyInput['mca_certificate'] = basename( $request->file('mca_certificate')->store('mca_certificate') );
        }
        CompanyDetail::create($companyInput);

        return redirect()->route('company-detail.index')->with('flash_message', 'Company Detail successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyDetail  $companyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyDetail $companyDetail)
    {
        //dd($companyDetail->toArray());
        return view('hrms.companydetail.show', compact('companyDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyDetail  $companyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyDetail $companyDetail)
    {
        //dd($companyDetail->toArray());
        return view('hrms.companydetail.edit', compact('companyDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyDetail  $companyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyDetail $companyDetail)
    {
        //dd($request->toArray());
        $request->validate([
            'address' => 'required',
            'bank_details' => 'required',
            'pan' => 'required',
            'gst_num' => 'required',
            'soft_tech_num' => 'required',
            'other_details' => 'required',
        ]);

        $companyInput = $request->all();
        if($request->hasFile('moa_aoa')){
            Storage::delete('moa_aoa/'.$companyDetail->moa_aoa);
            $companyInput['moa_aoa'] = basename( $request->file('moa_aoa')->store('moa_aoa') );
        }
        if($request->hasFile('mca_certificate')){
            Storage::delete('mca_certificate/'.$companyDetail->mca_certificate);
            $companyInput['mca_certificate'] = basename( $request->file('mca_certificate')->store('mca_certificate') );
        }
        $companyDetail->update($companyInput);

        return redirect()->route('company-detail.edit', $companyDetail->id)->with('flash_message', 'Company Detail successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyDetail  $companyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyDetail $companyDetail)
    {
        //dd($companyDetail->toArray());
        Storage::delete("moa_aoa/".$companyDetail->moa_aoa);
        Storage::delete("mca_certificate/".$companyDetail->mca_certificate);
        $companyDetail->delete();

        return redirect()->route('company-detail.index')->with('flash_message', 'Company Detail successfully deleted!');
    }
}
