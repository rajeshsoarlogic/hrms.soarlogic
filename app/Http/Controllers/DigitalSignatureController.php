<?php

namespace App\Http\Controllers;

use App\DigitalSignature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DigitalSignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatures = DigitalSignature::paginate(5);
        //dd($signatures->toArray());
        return view('hrms.digitalsig.index', compact('signatures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrms.digitalsig.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->toArray());
        $request->validate([
            'title' => 'required',
            'signature' => 'required',
        ]);

        $sig_name = Carbon::now()->format('YmdHs').".png";
        
        $digSigInput = $request->all();
        $digSigInput['signature'] = $sig_name;
        DigitalSignature::create($digSigInput);

        $encoded_image = explode(",", $request->signature)[1];
        $decoded_image = base64_decode($encoded_image);
        Storage::disk('local')->put("signature/$sig_name", $decoded_image);

        return redirect()->route('digital-sig.index')->with('flash_message', 'Signature successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DigitalSignature  $digitalSignature
     * @return \Illuminate\Http\Response
     */
    public function show(DigitalSignature $digitalSignature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DigitalSignature  $digitalSignature
     * @return \Illuminate\Http\Response
     */
    public function edit(DigitalSignature $signature, $id)
    {
        $signature = DigitalSignature::find($id);
        //dd($signature->toArray());
        return view('hrms.digitalsig.edit', compact('signature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DigitalSignature  $digitalSignature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->toArray());
        $request->validate([
            'title' => 'required',
        ]);

        $digSigInput = $request->all();
        $digitalSignature = DigitalSignature::findOrFail($id);
        $digSigInput['signature'] = $digitalSignature->signature;
        if( $request->signature != '' ){
            //delete old signature
            Storage::delete("signature/".$digitalSignature->signature);

            //add new signature
            $sig_name = $digitalSignature->signature;
            $encoded_image = explode(",", $request->signature)[1];
            $decoded_image = base64_decode($encoded_image);
            Storage::disk('local')->put("signature/$sig_name", $decoded_image);
            $digSigInput['signature'] = $sig_name;
        }
        $digitalSignature->update($digSigInput);

        return redirect()->route('digital-sig.edit', $digitalSignature->id)->with('flash_message', 'Signature successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DigitalSignature  $digitalSignature
     * @return \Illuminate\Http\Response
     */
    public function destroy(DigitalSignature $digitalSignature, $id)
    {
        $digitalSignature = DigitalSignature::find($id);
        //dd($digitalSignature->toArray());
        Storage::delete("signature/".$digitalSignature->signature);
        $digitalSignature->delete();

        return redirect()->route('digital-sig.index')->with('flash_message', 'Signature successfully deleted!');
    }
}
