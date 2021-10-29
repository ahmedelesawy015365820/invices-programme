<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Invoice_attachments;
use App\Invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = Invoice_details::where('id_Invoice',$id)->get();
        $attachments  = Invoice_attachments::where('invoice_id',$id)->get();

        return view('invoice.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = Invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();

        $attach = Storage::disk("attachment")->delete($request->invoice_number.'/'.$request->file_name);

        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function open_file($invoice,$attachment)
    {

        // $attach = Storage::disk("attachment")->getDriver()->getAdapter()
        // ->applyPathPrefix($invoice . "/" . $attachment);

        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice.'/'.$attachment);
        return response()->file($files);
    }

    public function dowonload($invoice,$attachment)
    {

        $attach = storage_path()::disk("attachment")->getDriver()->getAdapter()
        ->applyPathPrefix($invoice . "/" . $attachment);

        return response()->download($attach);

    }

}
