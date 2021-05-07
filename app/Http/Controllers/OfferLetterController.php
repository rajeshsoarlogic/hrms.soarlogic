<?php

namespace App\Http\Controllers;

use App\OfferLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\User;
use App\Stamp;
use PDF;
use Carbon\Carbon;
use App\Policy;
use App\Models\Employee;
use App\Models\UserRole;
use App\DigitalSignature;
use App\Template;

class OfferLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerLetters = OfferLetter::paginate(5);
        //dd($offerLetters->toArray());
        return view('hrms.offerletter.index', compact('offerLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stamps = Stamp::get();
        $signatures = DigitalSignature::get();
        $templates = Template::get();
        //dd($templates->toArray());

        return view('hrms.offerletter.add', compact('stamps', 'signatures', 'templates'));
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
            'email' => 'required|email|unique:offer_letters',
            'template_id' => 'required',
            'description' => 'required',
            'stamp_id' => 'required',
            'digital_signature_id' => 'required',
        ]);

        $current_date = Carbon::now()->format('YmdHs');
        $pdf_name = "offerletter-$current_date.pdf";

        $token = Str::random(60);

        $offerLetterInput = $request->all();
        $offerLetterInput['pdf_name'] = $pdf_name;
        $offerLetterInput['token'] = $token;
        OfferLetter::create($offerLetterInput);
        
        $pdf_data["candidate_email"] = $request->email;
        $pdf_data["candidate_name"] = $request->name;
        $pdf_data["stamp_info"] = Stamp::find($request->stamp_id);
        $pdf_data["offer_letter"] = $request->description;
        $pdf_data["sig_info"] = DigitalSignature::find($request->digital_signature_id);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.offerletter', ['data' => $pdf_data]);
        Storage::put("offerletter/$pdf_name", $pdf->output());

        $email_data['cand_email'] = $cand_email = $pdf_data["candidate_email"];
        $email_data['cand_name'] = $cand_name = $pdf_data["candidate_name"];
        $email_data["offerletterUrl"] = route('accept.offerletter', $token);
        if($request->other_emails != ''){
            $other_emails = explode(',',$request->other_emails);
        }else{
            $other_emails = array();
        }

        /*send mail to employee, for offerletter page link, so he can sign it*/
        Mail::send('emails.emp_offerletter', $email_data, function($message) use($cand_email, $cand_name, $other_emails)
        {
            $message->from("hr@soarlogic.com", "HR Soarlogic");
            $message->to($cand_email, $cand_name)->subject('Offer Letter From Soarlogic Pvt. Ltd.');
            if(count($other_emails) > 0){
                $message->bcc($other_emails);
            }
        });

        return redirect()->route('offer-letter.create')->with('flash_message', 'Offer Letter successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function show(OfferLetter $offerLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferLetter $offerLetter)
    {
        $stamps = Stamp::get();
        $signatures = DigitalSignature::get();
        $templates = Template::get();
        //dd($offerLetter->toArray());

        return view('hrms.offerletter.edit', compact('offerLetter', 'stamps', 'signatures', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferLetter $offerLetter)
    {
        //dd($offerLetter->toArray());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'template_id' => 'required',
            'description' => 'required',
            'stamp_id' => 'required',
            'digital_signature_id' => 'required',
        ]);

        $pdf_name = $offerLetter->pdf_name;
        Storage::delete("offerletter/".$offerLetter->pdf_name);

        $token = Str::random(60);

        $offerLetterInput = $request->all();
        $offerLetterInput['pdf_name'] = $pdf_name;
        $offerLetterInput['token'] = $token;
        $offerLetter->update($offerLetterInput);

        $pdf_data["candidate_email"] = $request->email;
        $pdf_data["candidate_name"] = $request->name;
        $pdf_data["stamp_info"] = Stamp::find($request->stamp_id);
        $pdf_data["offer_letter"] = $request->description;
        $pdf_data["sig_info"] = DigitalSignature::find($request->digital_signature_id);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.offerletter', ['data' => $pdf_data]);
        Storage::put("offerletter/$pdf_name", $pdf->output());

        $email_data['cand_email'] = $cand_email = $pdf_data["candidate_email"];
        $email_data['cand_name'] = $cand_name = $pdf_data["candidate_name"];
        $email_data["offerletterUrl"] = route('accept.offerletter', $token);
        if($request->other_emails != ''){
            $other_emails = explode(',',$request->other_emails);
        }else{
            $other_emails = array();
        }

        /*send mail to employee, for offerletter page link, so he can sign it*/
        Mail::send('emails.emp_offerletter', $email_data, function($message) use($cand_email, $cand_name, $other_emails)
        {
            $message->from("hr@soarlogic.com", "HR Soarlogic");
            $message->to($cand_email, $cand_name)->subject('Offer Letter From Soarlogic Pvt. Ltd.');
            if(count($other_emails) > 0){
                $message->bcc($other_emails);
            }
        });

        return redirect()->route('offer-letter.edit', $offerLetter->id)->with('flash_message', 'Offer Letter successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferLetter $offerLetter)
    {
        $candidate = User::where('email',$offerLetter->email)->get();
        if($candidate->count()){
            $candidate = $candidate->first();
            $candidate->offerletter = 0;
            $candidate->update();
        }
        //dd($candidate->toArray());
        if($offerLetter->emp_signature != ''){
            Storage::delete("offerletter/sig/emp/".$offerLetter->emp_signature);
        }
        Storage::delete("offerletter/".$offerLetter->pdf_name);
        $offerLetter->delete();

        return redirect()->route('offer-letter.index')->with('flash_message', 'offerLetter successfully deleted!');
    }

    /**
     * Show the offerletter (using token) to sign by employee.
     *
     * @param  $token
     * @return \Illuminate\Http\Response
     */
    public function acceptOfferletter($token)
    {
        $offerLetter = OfferLetter::with('stamp')->where('token', $token)->where('accepted',0)->first();
        $policies = Policy::get();
        //dd($offerLetter->toArray());

        if($offerLetter != NULL){
            $signature = DigitalSignature::find($offerLetter->digital_signature_id);
            return view('hrms.offerletter.accept', compact('offerLetter', 'signature', 'policies'));
        }else{
            return redirect()->route('login')->with('flash_message', 'Already signed the offerletter! login here now');
        }
    }

    /**
     * save the offer letter of employee after signed.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function acceptOfferletterProcess(Request $request)
    {
        //dd($request->toArray());

        $request->validate([
            'id' => 'required',
            'emp_sig' => 'required',
        ]);

        $encoded_image = explode(",", $request->emp_sig)[1];
        $decoded_image = base64_decode($encoded_image);
        $emp_sig_name = time().".png";

        $offerLetter = OfferLetter::find($request->id);
        $offerLetter->accepted = 1;
        $offerLetter->emp_signature = $emp_sig_name;
        $offerLetter->token = null;
        $offerLetter->save();

        Storage::disk('local')->put("offerletter/sig/emp/$emp_sig_name", $decoded_image);

        //update or save candidate to db
        $candidate = User::where('email',$offerLetter->email)->get();
        if($candidate->count()){
            $candidate = $candidate->first();
            $candidate->offerletter = 1;
            $candidate->update();
        }else{
            $candidate           = new User;
            $candidate->name     = $offerLetter->name;
            $candidate->email    = $offerLetter->email;
            $candidate->password = bcrypt('123456');
            $candidate->offerletter = 1;
            $candidate->save();
        }

        $filename = "profile_pic.png";
        $emp                       = new Employee;
        $emp->photo                = $filename;
        $emp->name                 = $offerLetter->name;
        $emp->status               = 1;
        $emp->user_id              = $candidate->id;
        $emp->save();

        $userRole          = new UserRole();
        $userRole->role_id = 13;
        $userRole->user_id = $candidate->id;
        $userRole->save();

        /*save offerletter pdf with emp sig*/
        $pdf_name = $offerLetter->pdf_name;
        Storage::delete("offerletter/".$offerLetter->pdf_name);

        $pdf_data["candidate_email"] = $offerLetter->email;
        $pdf_data["candidate_name"] = $offerLetter->name;
        $pdf_data["stamp_info"] = Stamp::find($offerLetter->stamp_id);
        $pdf_data["offer_letter"] = $offerLetter->description;
        $pdf_data["sig_info"] = DigitalSignature::find($offerLetter->digital_signature_id);
        $pdf_data["emp_sig_name"] = $offerLetter->emp_signature;

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf.offerletter', ['data' => $pdf_data]);
        Storage::put("offerletter/$pdf_name", $pdf->output());
        /*END*/

        //send mail to candidate to login
        Mail::send('emails.emp_reg', ['user' => $candidate, 'password' => '123456'], function($message) use($candidate)
        {
          $message->from("hr@soarlogic.com", "HR Soarlogic");
          $message->to($candidate->email, $candidate->name)->subject('Congratulation For Accepting Soarlogic offer');
        });

        $res['redirect_url'] = route('login');
        $res['success'] = true;
        $request->session()->flash('flash_message', 'Login link send to your email, Please check your email');

        return response()->json($res, 200);
    }

    /**
     * reject offerletter.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rejectOfferletterProcess(Request $request)
    {
        //dd($request->toArray());

        $request->validate([
            'id' => 'required',
        ]);

        $offerLetter = OfferLetter::find($request->id);
        $offerLetter->accepted = 0;
        $offerLetter->token = null;
        $offerLetter->save();

        $candidate = User::where('email',$offerLetter->email)->get();
        if($candidate->count()){
            $candidate = $candidate->first();
            $candidate->offerletter = 0;
            $candidate->update();
        }

        $res['redirect_url'] = route('login');
        $res['success'] = true;

        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OfferLetter  $offerLetter
     * @return \Illuminate\Http\Response
     */
    public function myOfferLetter($userid)
    {
        $user = User::where('id', $userid)->first();
        $offerLetter = OfferLetter::where('email',$user->email)->first();
        $stamp = Stamp::find($offerLetter->stamp_id);
        //dd($stamp->toArray());

        return view('hrms.offerletter.myofferletter', compact('offerLetter', 'stamp'));
    }
}
