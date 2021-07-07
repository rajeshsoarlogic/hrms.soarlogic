<?php

namespace App\Http\Controllers;

use App\EmployeeCategory;
use App\User;

use Illuminate\Http\Request;

class EmployeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = EmployeeCategory::paginate(10);
        //dd($categories->toArray());
        return view('hrms.employee.category.index', compact('categories'));
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

        return view('hrms.employee.category.add', compact('emps'));
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
            'title' => 'required|unique:employee_categories',
        ]);

        $catInput = $request->all();
        EmployeeCategory::create($catInput);
        
        return redirect()->route('employee-category.index')->with('flash_message', 'Category successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeCategory $employeeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeCategory $category, $id)
    {
        $category = EmployeeCategory::whereid($id)->first();
        //dd($category->toArray());

        return view('hrms.employee.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeCategory $employeeCategory)
    {
        //dd($employeeCategory->toArray());

        $request->validate([
            'title' => 'required|unique:employee_categories',
        ]);

        $catInput = $request->all();
        $employeeCategory->update($catInput);
        
        return redirect()->route('employee-category.edit', $employeeCategory->id)->with('flash_message', 'Category successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeCategory $employeeCategory)
    {
        //dd($employeeCategory->toArray());
        $employeeCategory->delete();

        return redirect()->route('employee-category.index')->with('flash_message', 'Category successfully deleted!');
    }
}
