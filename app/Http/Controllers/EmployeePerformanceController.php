<?php

namespace App\Http\Controllers;

use App\EmployeePerformance;
use App\User;
use App\Department;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeePerformanceController extends Controller
{
    public $qualities = array(
        "1" => "UNSATISFACTORY",
        "2" => "SATISFACTORY",
        "3" => "GOOD",
        "4" => "EXCELLENT"
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $performances = EmployeePerformance::paginate(5);
        $qualities = $this->qualities;
        //dd($performances->toArray());
        return view('hrms.employee.performance.index', compact('performances', 'qualities'));
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
        })->with('employee.department')->get();
        $departments = Department::get();
        $qualities = $this->qualities;
        //dd($emps->toArray());

        return view('hrms.employee.performance.add', compact('emps', 'departments', 'qualities'));
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
            'employee_id' => 'required',
            //'department_id' => 'required',
            'reviewer_name' => 'required',
            'reviewer_title' => 'required',
            'review_date' => 'required',
            'potential' => 'required',
            'work_quality' => 'required',
            'work_consistency' => 'required',
            'communication' => 'required',
            'independent_work' => 'required',
            'takes_initiative' => 'required',
            'group_work' => 'required',
            'productivity' => 'required',
            'creativity' => 'required',
            'honesty' => 'required',
            'integrity' => 'required',
            'coworker_relations' => 'required',
            'client_relations' => 'required',
            'technical_skills' => 'required',
            'dependability' => 'required',
            'punctuallity' => 'required',
            'attendance' => 'required',
            'previous_review_goals_achieved' => 'required',
            'goals_for_next_review' => 'required',
            'comment_and_approval' => 'required',
        ]);
        
        $current_date = Carbon::now()->format('YmdHs');

        $empPerfInput = $request->all();
        EmployeePerformance::create($empPerfInput);

        return redirect()->route('employee-performance.create')->with('flash_message', 'Employee Performance successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeePerformance  $employeePerformance
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeePerformance $employeePerformance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeePerformance  $employeePerformance
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeePerformance $employeePerformance)
    {
        $emps = User::whereHas('role', function ($q) {
            $q->whereNotIn('role_id', [1,2]);
        })->with('employee')->get();
        $departments = Department::get();
        $qualities = $this->qualities;
        //dd($employeePerformance->toArray());

        return view('hrms.employee.performance.edit', compact('employeePerformance', 'emps', 'departments', 'qualities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeePerformance  $employeePerformance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeePerformance $employeePerformance)
    {
        //dd($offerLetter->toArray());

        $request->validate([
            'employee_id' => 'required',
            //'department_id' => 'required',
            'reviewer_name' => 'required',
            'reviewer_title' => 'required',
            'review_date' => 'required',
            'potential' => 'required',
            'work_quality' => 'required',
            'work_consistency' => 'required',
            'communication' => 'required',
            'independent_work' => 'required',
            'takes_initiative' => 'required',
            'group_work' => 'required',
            'productivity' => 'required',
            'creativity' => 'required',
            'honesty' => 'required',
            'integrity' => 'required',
            'coworker_relations' => 'required',
            'client_relations' => 'required',
            'technical_skills' => 'required',
            'dependability' => 'required',
            'punctuallity' => 'required',
            'attendance' => 'required',
            'previous_review_goals_achieved' => 'required',
            'goals_for_next_review' => 'required',
            'comment_and_approval' => 'required',
        ]);


        $empPerfInput = $request->all();
        $employeePerformance->update($empPerfInput);

        return redirect()->route('employee-performance.edit', $employeePerformance->id)->with('flash_message', 'Employee Performance successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeePerformance  $employeePerformance
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeePerformance $employeePerformance)
    {
        $employeePerformance->delete();

        return redirect()->route('employee-performance.index')->with('flash_message', 'Employee Performance successfully deleted!');
    }
}
