<?php
namespace App\Http\Controllers;

use App\Appraisal;
use App\User;
use App\Stamp;
use Carbon\Carbon;
use PDF;
use App\DigitalSignature;
use App\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letters = Appraisal::with('user')->paginate(5);
        //dd($letters->toArray());
        return view('hrms.appraisal.index', compact('letters'));
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
        $stamps = Stamp::get();
        $signatures = DigitalSignature::get();
        $templates = Template::get();
        //dd($emps->toArray());

        return view('hrms.appraisal.add', compact('emps', 'stamps', 'signatures', 'templates'));
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
            'template_id' => 'required',
            'description' => 'required',
            'stamp_id' => 'required',
            'digital_signature_id' => 'required',
        ]);
        
        $current_date = Carbon::now()->format('YmdHs');
        $pdf_name = "appraisal-$current_date.pdf";

        $appraisalInput = $request->all();
        $appraisalInput['pdf_name'] = $pdf_name;
        Appraisal::create($appraisalInput);

        $user = User::find($request->user_id);
        
        $pdf_data["emp_email"] = $user->email;
        $pdf_data["emp_name"] = $user->name;
        $pdf_data["stamp_info"] = Stamp::find($request->stamp_id);
        $pdf_data["appraisal"] = $request->description;
        $pdf_data["sig_info"] = DigitalSignature::find($request->digital_signature_id);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.appraisal', ['data' => $pdf_data]);
        Storage::put("appraisal/$pdf_name", $pdf->output());

        $email_data['emp_email'] = $emp_email = $pdf_data["emp_email"];
        $email_data['emp_name'] = $emp_name = $pdf_data["emp_name"];
        
        /*send mail to employee, for offerletter page link, so he can sign it*/
        Mail::send('emails.appraisal', $email_data, function($message) use($emp_email, $emp_name, $pdf_name)
        {
            $message->from("hr@soarlogic.com", "HR Soarlogic");
            $message->to($emp_email, $emp_name)->subject('Appraisal Letter From Soarlogic Pvt. Ltd.');
            $message->attach(asset('storage/app/appraisal/'.$pdf_name));
        });

        return redirect()->route('appraisal.index')->with('flash_message', 'Appraisal Letter successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function show(Appraisal $appraisal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function edit(Appraisal $appraisal)
    {
        $emps = User::whereHas('role', function ($q) {
            $q->whereNotIn('role_id', [1,2]);
        })->with('employee')->get();
        $stamps = Stamp::get();
        $signatures = DigitalSignature::get();
        $templates = Template::get();
        //dd($offerLetter->toArray());

        return view('hrms.appraisal.edit', compact('appraisal', 'emps', 'stamps', 'signatures', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appraisal $appraisal)
    {
        //dd($offerLetter->toArray());

        $request->validate([
            'user_id' => 'required',
            'template_id' => 'required',
            'description' => 'required',
            'stamp_id' => 'required',
            'digital_signature_id' => 'required',
        ]);

        $pdf_name = $appraisal->pdf_name;
        Storage::delete("appraisal/".$appraisal->pdf_name);

        $appraisalInput = $request->all();
        $appraisalInput['pdf_name'] = $pdf_name;
        $appraisal->update($appraisalInput);

        $user = User::find($request->user_id);
        
        $pdf_data["emp_email"] = $user->email;
        $pdf_data["emp_name"] = $user->name;
        $pdf_data["stamp_info"] = Stamp::find($request->stamp_id);
        $pdf_data["appraisal"] = $request->description;
        $pdf_data["sig_info"] = DigitalSignature::find($request->digital_signature_id);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.appraisal', ['data' => $pdf_data]);
        Storage::put("appraisal/$pdf_name", $pdf->output());

        $email_data['emp_email'] = $emp_email = $pdf_data["emp_email"];
        $email_data['emp_name'] = $emp_name = $pdf_data["emp_name"];
        
        /*send mail to employee, for offerletter page link, so he can sign it*/
        Mail::send('emails.appraisal', $email_data, function($message) use($emp_email, $emp_name, $pdf_name)
        {
            $message->from("hr@soarlogic.com", "HR Soarlogic");
            $message->to($emp_email, $emp_name)->subject('Appraisal Letter From Soarlogic Pvt. Ltd.');
            $message->attach(asset('storage/app/appraisal/'.$pdf_name));
        });

        return redirect()->route('appraisal.edit', $appraisal->id)->with('flash_message', 'Appraisal Letter successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appraisal $appraisal)
    {
        Storage::delete("appraisal/".$appraisal->pdf_name);
        $appraisal->delete();

        return redirect()->route('appraisal.index')->with('flash_message', 'Appraisal Letter successfully deleted!');
    }
}
