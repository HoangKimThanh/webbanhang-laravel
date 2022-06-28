<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Mail\Invoice as MailInvoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('admin.invoices.index', ['invoices' => $invoices]);
    }

    public function ajax(Request $request)
    {
        $action = $request->get('action');
        $invoiceId = $request->get('id');
        switch ($action) {
            case 'show':
                return $this->showAjax($invoiceId);
                break;

            case 'update':
                $status = $request->get('status');
                return $this->update($invoiceId, $status);
                break;

            case 'delete':
                return $this->destroy($invoiceId);
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = new Invoice();
        $invoice->fill($request->validated());
        $invoice->user_id = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : 0;
        // dd($invoice->user_id);
        $invoice->total = Session::get('cart_total');
        $invoiceId = uniqid();
        $invoice->id = $invoiceId;
        $invoice->save();

        $cart = Session::get('cart');

        foreach ($cart as $item) {
            $invoiceDetail = new InvoiceDetail();

            $invoiceDetail->invoice_id = $invoiceId;
            $invoiceDetail->product_id = $item['id'];
            $invoiceDetail->quantity = $item['quantity'];
            $invoiceDetail->price = $item['price'];

            $invoiceDetail->save();
        }

        Mail::to($request->receiver_email)->send(new \App\Mail\Invoice($invoiceId));

        Session::forget('cart');
        Session::forget('cart_total');
        Session::save();

        return view('pages.order-success', compact('invoiceId'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $invoiceId = $request->invoice_id;

        $invoice = Invoice::find($invoiceId);

        $invoiceDetails = InvoiceDetail::getInvoiceDetails($invoiceId);

        return view('pages.invoice-lookup', compact('invoice', 'invoiceDetails', 'invoiceId'));
    }

    public function showAjax($invoiceId)
    {
        $invoiceDetails = InvoiceDetail::getInvoiceDetails($invoiceId);

        $str = '<table border="1">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>';
        $i = 0;
        foreach ($invoiceDetails as $each) {
            $i++;
            $str .= '<tr>
                <th>' . $i . '</th>
                <th><img src="' . asset('img/uploads/' . $each->image_main) . '" alt=""></th>
                <th>' . $each->name . '</th>
                <th>' . $each->quantity . '</th>
                <th>' . $each->price . '</th>
            </tr>';
        }
        $str .= '</tbody>';

        return response()->json(array(
            'str' => $str,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update($invoiceId, $status)
    {
        $invoice = Invoice::find($invoiceId);
        $invoice->status = $status;

        $invoice->save();

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $invoice->delete();
        return response()->json([
            'msg' => 'Invoice deleted successfully',
        ]);
    }

    public function history()
    {
        $invoices = Invoice::whereUserId(Auth::guard('user')->user()->id)->get();

        return view('pages.invoice-history', compact('invoices'));
    }
}
