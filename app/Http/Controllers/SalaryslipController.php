<?php

namespace App\Http\Controllers;

use App\Salaryslip;
use App\User;
use App\Models\Role;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SalaryslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slips = Salaryslip::with('employee')->paginate(10);
        //dd($slips->toArray());
        return view('hrms.salaryslip.index', compact('slips'));
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
        $roles = Role::get();
        //dd($roles->toArray());
        return view('hrms.salaryslip.add', compact('emps', 'roles'));
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
            'user_id' => 'required',
            'department' => 'required',
            'month_year' => 'required',
            'pan' => 'required',
            'role_id' => 'required',
            'basic' => 'required',
            'da' => 'required',
            'hra' => 'required',
            'conveyance_allow' => 'required',
            'education_allow' => 'required',
            'medical_allow' => 'required',
            'internet_allow' => 'required',
            'special_allow' => 'required',
            'p_fund' => 'required',
            'taxes' => 'required',
        ]);

        $current_date = Carbon::now()->format('YmdHs');
        $pdf_name = "salaryslip-$current_date.pdf";

        $slipInput = $request->all();
        $slipInput['pdf_name'] = $pdf_name;
        $salaryslip = Salaryslip::create($slipInput);
        $designation = Role::find($salaryslip->role_id);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.salaryslip', ['request' => $salaryslip, 'designation' => $designation]);
        Storage::put("salaryslip/$pdf_name", $pdf->output());

        return redirect()->route('salaryslip.create')->with('flash_message', 'Salaryslip successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salaryslip  $salaryslip
     * @return \Illuminate\Http\Response
     */
    public function show(Salaryslip $salaryslip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salaryslip  $salaryslip
     * @return \Illuminate\Http\Response
     */
    public function edit(Salaryslip $salaryslip)
    {
        $emps = User::whereHas('role', function ($q) {
            $q->whereNotIn('role_id', [1,2]);
        })->with('employee')->get();
        $roles = Role::get();
        //dd($salaryslip->toArray());
        return view('hrms.salaryslip.edit', compact('salaryslip', 'emps', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salaryslip  $salaryslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salaryslip $salaryslip)
    {
        //dd($salaryslip->toArray());
        
        $request->validate([
            'user_id' => 'required',
            'department' => 'required',
            'month_year' => 'required',
            'pan' => 'required',
            'role_id' => 'required',
            'basic' => 'required',
            'da' => 'required',
            'hra' => 'required',
            'conveyance_allow' => 'required',
            'education_allow' => 'required',
            'medical_allow' => 'required',
            'internet_allow' => 'required',
            'special_allow' => 'required',
            'p_fund' => 'required',
            'taxes' => 'required',
        ]);

        $slipInput = $request->all();
        $salaryslip->update($slipInput);

        $salaryslip = Salaryslip::with('employee')->find($salaryslip->id);
        $designation = Role::find($salaryslip->role_id);

        $pdf_name = $salaryslip->pdf_name;
        Storage::delete("salaryslip/".$salaryslip->pdf_name);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.salaryslip', ['request' => $salaryslip, 'designation' => $designation]);
        Storage::put("salaryslip/$pdf_name", $pdf->output());

        return redirect()->route('salaryslip.edit', $salaryslip->id)->with('flash_message', 'Salaryslip successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salaryslip  $salaryslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salaryslip $salaryslip)
    {
        //dd($salaryslip->toArray());
        Storage::delete("salaryslip/".$salaryslip->pdf_name);
        $salaryslip->delete();

        return redirect()->route('salaryslip.index')->with('flash_message', 'Salaryslip successfully deleted!');
    }
}
