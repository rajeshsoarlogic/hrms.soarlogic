<?php

namespace App\Http\Controllers;

use App\CompanyExpense;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$expenses = CompanyExpense::with('employee')->paginate(10);
        $expenses = CompanyExpense::paginate(10);
        //dd($expenses->toArray());
        return view('hrms.companyexpense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emps = Employee::get();
        //dd($emps->toArray());
        return view('hrms.companyexpense.add', compact('emps'));
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
            //'employee_id' => 'required',
            'item' => 'required',
            'purchase_from' => 'required',
            'date_of_purchase' => 'required',
            'amount' => 'required',
        ]);

        $companyExpenseInput = $request->all();
        $companyExpenseInput['date_of_purchase'] = date_format(date_create($request->date_of_purchase), 'Y-m-d');
        CompanyExpense::create($companyExpenseInput);

        return redirect()->route('company-expense.index')->with('flash_message', 'Company Expense successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyExpense  $companyExpense
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyExpense $companyExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyExpense  $companyExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyExpense $companyExpense)
    {
        $emps = Employee::get();
        //dd($emps->toArray());
        return view('hrms.companyexpense.edit', compact('companyExpense', 'emps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyExpense  $companyExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyExpense $companyExpense)
    {
        //dd($companyExpense->toArray());
        $request->validate([
            //'employee_id' => 'required',
            'item' => 'required',
            'purchase_from' => 'required',
            'date_of_purchase' => 'required',
            'amount' => 'required',
        ]);

        $companyExpenseInput = $request->all();
        $companyExpenseInput['date_of_purchase'] = date_format(date_create($request->date_of_purchase), 'Y-m-d');
        $companyExpense->update($companyExpenseInput);

        return redirect()->route('company-expense.edit', $companyExpense->id)->with('flash_message', 'Expense successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyExpense  $companyExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyExpense $companyExpense)
    {
        //dd($companyExpense->toArray());
        $companyExpense->delete();

        return redirect()->route('company-expense.index')->with('flash_message', 'Expense successfully deleted!');
    }
}
