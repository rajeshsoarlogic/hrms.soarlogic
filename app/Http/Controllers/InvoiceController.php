<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        //dd($recruiters->toArray());
        return view('hrms.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd($skills->toArray());
        $clients = Client::get();
        return view('hrms.invoice.add', compact('clients'));
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
            'invoice' => 'required|mimes:pdf,xlsx,xls',
            'date' => 'required',
            'client_id' => 'required',
        ]);

        $invoiceInput = $request->all();
        $path = $request->file('invoice')->store('invoices');
        $invoiceInput['invoice'] = basename($path);
        Invoice::create($invoiceInput);

        return redirect()->route('invoice.create')->with('flash_message', 'Invoice successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //dd($invoice->toArray());
        $clients = Client::get();
        return view('hrms.invoice.edit', compact('invoice', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //dd($request->toArray());
        $request->validate([
            'title' => 'required',
            'invoice' => 'mimes:pdf,xlsx,xls',
            'date' => 'required',
            'client_id' => 'required',
        ]);

        $invoiceInput = $request->all();
        if($request->hasFile('invoice')){
            Storage::delete('invoices/'.$invoice->invoice);
            $invoiceInput['invoice'] = basename($request->file('invoice')->store('invoices'));
        }
        $invoice->update($invoiceInput);

        return redirect()->route('invoice.edit', $invoice->id)->with('flash_message', 'Invoice successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //dd($invoice->toArray());
        Storage::delete("invoices/".$invoice->invoice);
        $invoice->delete();

        return redirect()->route('invoice.index')->with('flash_message', 'Invoice successfully deleted!');
    }

    /**
     * Show the form to send invoice to client.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        $clients = Client::get();
        $invoices = Invoice::get();
        //dd($invoices->toArray());
        return view('hrms.invoice.send', compact('clients', 'invoices'));
    }

    /**
     * Get Client Invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientInvoice(Request $request)
    {
        $invoices = Invoice::where('client_id', $request->client_id)->get();
        //dd($invoices->toArray());
        $invoices = $invoices->toArray();
        return response()->json(array('invoices'=> $invoices), 200);
    }

    /**
     * Send invoice to client
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function sendInvoiceToClient(Request $request)
    {
        //dd($request->toArray());
        $request->validate([
            'client_id' => 'required',
            'emails' => 'required',
            'invoice_id' => 'required',
        ]);

        $invoiceIdArr = explode(',', rtrim($request->invoice_id, ','));

        $client = Client::find($request->client_id)->first();
        $invoices = Invoice::whereIn('id',$invoiceIdArr)->get();
        $email_data['client'] = $client->toArray();
        //$email_data['invoices'] = $invoices->toArray();
        $emails = explode(',',$request->emails);
        //dd($invoices->toArray());

        Mail::send('emails.invoice', $email_data, function($message) use($emails, $invoices)
        {
            $message->from("hr@soarlogic.com", "HR");
            $message->to($emails)->subject('Client Invoice');
            foreach($invoices as $invoice){
                $message->attach(asset('storage/app/invoices/'.$invoice->invoice));
            }
        });

        return redirect()->route('invoice.send')->with('flash_message', 'Invoice successfully sent!');
    }
}
