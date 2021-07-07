<?php

namespace App\Http\Controllers;

use App\PaymentDetails;
use App\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentDetails::with('client', 'invoice')->paginate(10);
        //dd($payments->toArray());
        return view('hrms.paymentdetails.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();
        $invoices = Invoice::get();
        //dd($invoices->toArray());
        return view('hrms.paymentdetails.add', compact('clients', 'invoices'));
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
            'client_id' => 'required',
            'invoice_id' => 'required',
            'upload_file' => 'required|mimes:jpeg,png,jpg,pdf,xlsx,xls,doc',
            'date' => 'required',
        ]);

        $paymentDetailsInput = $request->all();
        $path = $request->file('upload_file')->store('paymentdetails');
        $paymentDetailsInput['upload_file'] = basename($path);
        PaymentDetails::create($paymentDetailsInput);

        return redirect()->route('payment-details.index')->with('flash_message', 'Payment Details successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentDetails  $paymentDetails
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentDetails $paymentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentDetails  $paymentDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentDetails $paymentDetails, $id)
    {
        $paymentDetails = PaymentDetails::whereid($id)->first();
        $clients = Client::get();
        $invoices = Invoice::get();
        //dd($paymentDetails->toArray());
        return view('hrms.paymentdetails.edit', compact('paymentDetails', 'clients', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentDetails  $paymentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->toArray());
        $request->validate([
            'client_id' => 'required',
            'invoice_id' => 'required',
            'date' => 'required',
        ]);

        $paymentDetailsInput = $request->all();
        if($request->hasFile('upload_file')){
            Storage::delete('paymentdetails/'.$invoice->upload_file);
            $paymentDetailsInput['upload_file'] = basename($request->file('upload_file')->store('paymentdetails'));
        }
        $paymentDetails = PaymentDetails::findOrFail($id);
        $paymentDetails->update($paymentDetailsInput);

        return redirect()->route('payment-details.edit', $paymentDetails->id)->with('flash_message', 'Invoice successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentDetails  $paymentDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentDetails $paymentDetails, $id)
    {
        $paymentDetails = PaymentDetails::find($id);
        //dd($paymentDetails->toArray());
        Storage::delete("paymentdetails/".$paymentDetails->upload_file);
        $paymentDetails->delete();

        return redirect()->route('payment-details.index')->with('flash_message', 'Invoice successfully deleted!');
    }
}
